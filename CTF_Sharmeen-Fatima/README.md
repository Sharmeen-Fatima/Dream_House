# Dream House — Security CTF Submission

**Student:** Sharmeen Fatima
**Assignment:** SQL Injection CTF + Hidden-Flag CTF (Web Security)

This submission has two parts, both built into the same "Dream House" real
estate website.

## Part 1 — Hidden Vulnerability / Flag Hunt (8 flags)
8 flags in the format `PicoCTF{...}` are hidden across the site using 8
different techniques (view-source, hidden/invisible text, Base64 in JS,
Base64 in CSS, robots.txt → unlinked page, image EXIF metadata, browser
cookies, and a hidden SVG favicon). Full details + solutions are in
`ctf_answer_key.md` (for grading — not meant to be handed to players).

## Part 2 — SQL Injection Login (new, this submission)
A "Staff Login" page was added at `admin/login.php`. Its backend
(`admin/check_login.php`) builds the SQL query by directly concatenating
the username/password fields — a classic, intentionally vulnerable
pattern — so it can be bypassed with several different SQL injection
payloads instead of the real password.

Full write-up, all 5 tested payloads, and the correct fix are documented in
`admin/SQLI_WRITEUP.md`.

### Quick start
```
php -S localhost:8000
```
Open `http://localhost:8000/index.html` for the main site, or go straight
to `http://localhost:8000/admin/login.php` for the vulnerable login.
(Requires PHP with the `pdo_sqlite` extension — ships with most default
PHP installs / XAMPP.)

## File map
```
index.html, about.html, listings.html, team.html, contact.html   → main site
assets/                                                            → css/js/images
robots.txt, favicon.svg, vault/                                   → flag-hunt pieces
admin/login.php, check_login.php, dashboard.php, logout.php        → SQLi assignment
admin/config.php                                                   → auto-creates the SQLite DB
admin/SQLI_WRITEUP.md                                               → payloads + fix, for Part 2
ctf_answer_key.md                                                   → flag locations + solutions, for Part 1
```




---

🧠 **Author:** *[Sharmeen Fatima](https://github.com/sharmeen-fatima)*  
📅 **Last Updated:** *30 Auguest 2026*  

- **📫 Feel free to reach out: **✉️ (creativecoderpakistan@gmail.com).****
- ***✒ For more information about Cyber-Security and updates Join **[Whatsapp Channel](https://whatsapp.com/channel/0029VbAqY7w002TIRJYUHG3X).*****

***“Learning never stops — stay curious, stay creative!”***

***☺️STAY HERE, STAY CONNECTED✨***
