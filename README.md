# Dream House — CTF Challenge Website

## Overview

**Dream House** is a Capture The Flag (CTF) style practice website, purpose-built for **Cybersecurity students** who want to sharpen their real-world reconnaissance and web-security skills. Instead of a typical portfolio or real-estate site, Dream House hides **8 flags** across its pages and source files, each one requiring a different technique to uncover.

The idea is simple: browse the site like a normal visitor, then start thinking like an attacker (or a security researcher). Every flag mirrors a technique that shows up again and again in real-world bug bounty work, penetration testing, and web application security audits — so what you practice here directly transfers to real projects.

## Why This Project Exists

Most beginner CTF challenges feel disconnected from real work. Dream House is different — it's designed to feel like an **actual website** with an **actual security posture**, good and bad. As you dig through it, you'll encounter the same kinds of oversights that show up in production apps every day:

- Sensitive information left in page source or comments
- Content hidden through CSS instead of properly removed
- Secrets accidentally committed into JavaScript or stylesheets
- Paths disclosed through `robots.txt`
- Metadata leaking through uploaded images
- Client-side cookies storing more than they should
- Files people forget aren't "just icons" (like SVGs)

Each flag is a small lesson in a bigger security habit: **check everything, trust nothing at face value.**

## Who This Is For

- Cybersecurity students building foundational recon skills
- Beginners preparing for platforms like PicoCTF, TryHackMe, or HackTheBox
- Anyone who wants hands-on practice with browser DevTools, source inspection, and file metadata analysis

No prior CTF experience is required, but basic familiarity with browsers, HTML/CSS/JS, and command-line tools will help.

## What You'll Practice

| Skill Area | Real-World Relevance |
|---|---|
| Viewing page source | First step in any web recon workflow |
| Inspecting the DOM & CSS | Finding what's hidden vs. what's deleted |
| Decoding encoded data (Base64, etc.) | Common obfuscation technique attackers/devs both use |
| Reading `robots.txt` | Classic recon step for discovering hidden paths |
| Extracting image metadata (EXIF) | Uploaded files often leak more than intended |
| Inspecting cookies & client storage | Understanding what's exposed client-side |
| Reading raw file formats (like SVG as XML) | Not every file is what it appears to be |

## Flag Format

All flags follow the standard format:

```
PicoCTF{...}
```

There are **8 flags total**, spread across different pages and files of the site. Each one uses a distinct technique — no single tool or trick will find more than one flag, so you'll need to combine multiple recon skills to complete the challenge.

## Difficulty Curve

The challenges are arranged to build confidence gradually:

- **Easy** — great starting points if you're new to recon
- **Medium** — require a bit more digging and tool usage
- **Hard** — combine multiple steps or require less obvious tools (like metadata extractors)

This gradual curve means you don't need to be an expert to start — just curious and methodical.

## How to Approach It

1. Browse the site normally first, like any visitor would.
2. Start inspecting — view source, check the DOM, look at loaded assets (CSS, JS, images).
3. Don't ignore "boring" files like `robots.txt` or a favicon — they're part of the challenge.
4. When you find encoded or unusual-looking data, don't assume it's random — decode it.
5. Keep track of what you've checked and what techniques you've already used; remember, every flag needs a *different* method.

## A Note on Ethics

This project is intentionally self-contained and safe: everything here revolves around **static files and client-side recon** — there is no server-side exploitation, no real user data, and nothing beyond what's meant to be found. The goal is to build good habits (careful inspection, healthy skepticism, attention to detail) that apply directly to responsible, real-world security work.

## Disclaimer

This is a **learning environment**. Flags and their exact locations are intentionally not documented here — figuring them out is the whole point. Have fun, be patient, and treat every discovery as a lesson you can carry into real-world security testing.

---

*Built for Cybersecurity students to bridge the gap between classroom theory and real-world web security practice.*

---

🧠 **Author:** *[Sharmeen Fatima](https://github.com/sharmeen-fatima)*  
📅 **Last Updated:** *30 Auguest 2026*  

- **📫 Feel free to reach out: **✉️ (creativecoderpakistan@gmail.com).****
- ***✒ For more information about Cyber-Security and updates Join **[Whatsapp Channel](https://whatsapp.com/channel/0029VbAqY7w002TIRJYUHG3X).*****

***“Learning never stops — stay curious, stay creative!”***

***☺️STAY HERE, STAY CONNECTED✨***
