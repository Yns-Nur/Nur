# Publishing this site on GitHub Pages

The site is static — no server, no database. GitHub builds it and serves it for
free, and every push updates the live site.

You need [Git](https://git-scm.com/download/win) and a GitHub account. You do
**not** need to install Node or run a build yourself; GitHub does that part.

---

## 1. Choose the address

Two options. Pick one before you make the repo, because the repo's **name** is
what decides the URL.

| Repo name | Live at | Notes |
|---|---|---|
| `<your-username>.github.io` | `https://<your-username>.github.io/` | The clean one. One per account. **Recommended for a portfolio.** |
| anything else, e.g. `yns-nur` | `https://<your-username>.github.io/yns-nur/` | Use if the name above is already taken by something else. |

Either works — the build reads the address from GitHub and adjusts itself. You
do not have to edit any file.

## 2. Make the repository

On GitHub: **New repository** → name it as chosen above → **Public** (Pages is
free only for public repos on the free plan) → do **not** tick "Add a README" →
**Create repository**.

## 3. Push this folder to it

Open a terminal in this folder and run these, replacing `YOUR-USERNAME` and
`REPO-NAME`:

```bash
git init -b main
git add .
git commit -m "Publish the YNS NUR site"
git remote add origin https://github.com/YOUR-USERNAME/REPO-NAME.git
git push -u origin main
```

The first `git push` asks you to sign in to GitHub — a browser window opens,
approve it there.

## 4. Turn Pages on

In the repository: **Settings** → **Pages** → under **Source** choose
**GitHub Actions**. That is the only setting to change.

## 5. Wait for the build

Open the **Actions** tab. A run called *Deploy to GitHub Pages* starts by
itself. It takes about a minute. When it goes green, the site is live at the URL
from step 1 — the run itself links to it.

If you turned on Pages *after* pushing, the first run may have already finished
without deploying. Open **Actions** → the latest run → **Re-run all jobs**.

---

## Updating the site later

Change what you want, then:

```bash
git add .
git commit -m "Describe what changed"
git push
```

Pushing to `main` is the publish step. GitHub rebuilds and the live site
updates a minute later.

## Working on it locally first

Optional, and only if you want to preview before publishing. Needs
[Node.js 22+](https://nodejs.org):

```bash
npm install
npm run dev
```

Then open http://localhost:4321. `npm run build` produces the finished site in
`dist/`, which is what GitHub does for you.

---

## Two things to know

- **The videos are placeholders.** Every clip in `public/media/placeholder/` is
  authored stand-in material, and the site says so on the page. Replace them
  with real work before you send anyone the link.
- **The contact form does not send anything.** It has no endpoint, on purpose —
  it validates and composes the enquiry in the browser and says plainly that
  nothing is sent. Wire it to a form service (Formspree, Basin) or swap it for
  an email address when you want it live.

## Using your own domain

Once it is up: **Settings** → **Pages** → **Custom domain**, enter the domain,
and add the DNS records GitHub shows you at your registrar. Tick **Enforce
HTTPS** once the check passes. Nothing in this repo needs to change.
