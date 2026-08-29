# Dream House — CTF Answer Key (private, don't share with players)

8 flags, all in the format `PicoCTF{...}`, spread across the site with different techniques.

| # | Flag | Where | Technique / How to find it |
|---|------|-------|------------------------------|
| 1 | `PicoCTF{v13w_s0urc3_1s_st1ll_g0ld}` | `index.html` | HTML comment inside `<head>`. Find via **View Page Source / Ctrl+U**. |
| 2 | `PicoCTF{1nv1s1bl3_t3xt_1s_st1ll_th3r3}` | `about.html` | Text is in the DOM but colored the same as the background (`.ghost-text` in `style.css`). Find via **Inspect Element**, select-all page text, or view source and spot the extra `<span>`. |
| 3 | `PicoCTF{b4s3_64_1s_n0t_3ncrypt10n}` | `assets/js/main.js` | An unused variable `_dbgSyncToken` holds a Base64 string. Must **decode Base64**. |
| 4 | `PicoCTF{c55_c4n_h1d3_s3cr3ts}` | `assets/css/style.css` | Base64 string stored in a CSS custom property `--build-id` on `:root`. Must actually read the CSS file (not just DevTools computed styles, since it's a string literal) and decode Base64. |
| 5 | `PicoCTF{r0b0ts_kn0w_wh4t_y0u_h1d3}` | `robots.txt` → `/vault/index.html` | `robots.txt` disallows `/vault/`. That page isn't linked from any nav menu — classic recon lesson: robots.txt often reveals hidden paths. |
| 6 | `PicoCTF{3x1f_d4t4_n3v3r_l13s}` | `assets/img/team-2.jpg` | Embedded in the image's **EXIF UserComment** metadata. Findable with `exiftool`, `strings team-2.jpg`, or Python (`piexif`/`Pillow`). |
| 7 | `PicoCTF{c00k1es_ar3nt_pr1v4t3}` | Set via `assets/js/main.js` (runs on every page, easiest to notice on `contact.html`) | A cookie named `dh_session` is set on page load, value is Base64. Check **DevTools → Application → Cookies**, then decode. |
| 8 | `PicoCTF{svg_f1l3s_h4v3_s3cr3ts_t00}` | `favicon.svg` | The favicon is an SVG (not a binary .ico), and SVGs are just text/XML. The flag sits in a `<desc>` tag and a comment — invisible when rendered as an icon, visible in **View Source of the .svg file itself**. |

## Difficulty spread
- **Easy:** #1 (view-source), #3 (obvious base64 var)
- **Medium:** #2 (invisible text), #4 (CSS custom prop), #7 (cookie inspection)
- **Hard:** #5 (needs the robots.txt → recon → hidden unlinked page chain), #6 (needs a metadata tool, not visible in any normal browsing), #8 (needs someone to think of favicon as a readable file, not just an icon)

## Notes
- All 8 are genuinely independent — no single tool finds more than one.
- Nothing here touches server-side code, exploits, or anything unsafe — it's all static-file steganography/recon, appropriate for a beginner-friendly PicoCTF-style exercise.
- If your sir wants it harder, easy upgrades: rotate/XOR-encode instead of Base64, split one flag across two files, or require a specific HTTP request header to reveal a 9th flag.
