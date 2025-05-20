Here’s a clear, modular **README** section you can drop into your project to help you (or anyone else) integrate Swiper into another Hugo project using your reusable setup:

---

## 🧭 How to Add Swiper to a Hugo Project

These steps assume your Hugo site is set up and you're copying over the modular Swiper setup from this repo.

### 🗂 1. **Copy Required Files**

Copy the following folders into your Hugo project:

```
layouts/
└── partials/
    └── swiper/
        ├── gallery.html
        ├── init.html
        └── ...
```

If you're using a single base template, also copy:

- `layouts/_default/swiper-gallery.html` or your custom layout file.

Optional: Copy any relevant CSS (if used) from:

```
assets/css/swiper.css
```

---

### 🧩 2. **Add Swiper CSS & JS to `baseof.html`**

In `layouts/_default/baseof.html`, add these **only once**, inside `<head>` and before `</body>`:

#### Inside `<head>`:

```html
<!-- Swiper CSS -->
<link
  rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"
/>
<link rel="stylesheet" href="{{ "css/swiper.css" | relURL }}" />
```

#### Before `</body>`:

```html
<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
{{ block "scripts" . }}{{ end }}
```

---

### 📄 3. **Create a Content Page**

Example: `content/gallery.md` or `content/single-swiper.md`

```toml
+++
title = "Gallery Page"
layout = "swiper-gallery"  # or your custom layout
[params]
swiperImages1 = [
  "https://source.unsplash.com/random/800x600?sig=1",
  "https://source.unsplash.com/random/800x600?sig=2"
]
swiperImages2 = [
  "https://source.unsplash.com/random/800x600?sig=3",
  "https://source.unsplash.com/random/800x600?sig=4"
]
+++

Welcome to the Gallery Page!
```

---

### 🧱 4. **Use the Modular Swiper Partials in Layout**

In your layout file (e.g., `layouts/_default/swiper-gallery.html`):

```go-html
{{ define "main" }}
  <h1>{{ .Title }}</h1>
  {{ partial "swiper/gallery.html" . }}
  {{ partial "swiper/init.html" . }}
{{ end }}
```

This renders all Swiper sliders based on any `[params]` key that starts with `swiperImages`.

---

### 🔁 5. **Add Your Styles (Optional)**

To style or override default Swiper appearance, update:

```
assets/css/swiper.css
```

---

### ✅ Done!

Now when you run:

```bash
hugo server -D --disableFastRender --noHTTPCache
```

You’ll see all your Swipers rendered automatically from `[params]` with navigation and pagination included.

---

Let me know if you want this as a `README.md` file or want a second version tailored for a **shortcode-based** setup.
