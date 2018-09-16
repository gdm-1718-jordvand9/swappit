Web Development II 2017-2018
============================

Student: Jordy Van der Haegen

> Artevelde University College Ghent

Productiedossier
----------------

### Installatie

```
PS> c
PS> git clone «repository-url» «MAPNAAM»
PS> c «MAPNAAM»
```

```
PS> c «MAPNAAM»
PS> cd docs
PS> bundle update
PS> bundle exec jekyll serve
```

### Jekyll-configuratie

In `_config.yml` pas je de `baseurl` aan, van:

```
# Site settings
# ─────────────
baseurl: /1718-webdev2-project # the subpath of your site, e.g. /blog
```

naar `«REPOSITORYNAAM»` (bv. `1718-webdev2-project-olivpa`):

```
# Site settings
# ─────────────
baseurl: /«REPOSITORYNAAM» # the subpath of your site, e.g. /blog
```

### GitHub Pages Configuratie

Op GitHub ga je naar je repository en klik op **Settings**. Scroll naar beneden tot aan **GitHub Pages**, zet de **Source** op `master branch /docs folder` en klik op **Save** om te bewaren.

### Voorbeeldsite

 - Basissjabloon <https://gdmgent-1718-webdev2.github.io/1718-webdev2-project>
 - Persoonlijke repo van Olivier Parent <https://gdmgent-1718-webdev2.github.io/1718-webdev2-project-olivpa>