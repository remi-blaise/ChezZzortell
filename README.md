# ChezZz Repo

Repository of the website: http://remi-blaise.com/

## Deployment

1) Run locally:
```bash
sfcc_prod
bin/console assetic:dump --env=prod --no-debug
bin/console assets:install
```

2) Upload files
On root, upload composer.json only (cause used to calculate [getProjectDir()](https://symfony.com/blog/new-in-symfony-3-3-a-simpler-way-to-get-the-project-root-directory)).

3) In the web dir, delete bundles et css folders and replace them.

For debugging, upload app_dev.php.

## TODO

- Add a form to the browser warning
  for setting a cookie to hide the browser warning (lifetime: 4 or 7 days ?)
- Optimize images
- Notebook: A list of tags, with a link to the main page.
- Notebook: Add a search engine
- Articles: Memo & Blog
- Compete the TODO list

## License

Copyright © 2015 Rémi Blaise <remi.blaise@gmx.fr>

Notes, ie. every file placed in the `Resources/notes/` folder,
are under the Do What The Fuck You Want To Public License, Version 2,
as published by Sam Hocevar.
See the [`Resources/meta/WTFPL`](Resources/meta/WTFPL) file for more details.
