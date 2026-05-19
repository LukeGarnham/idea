<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://github.com/LukeGarnham/idea/blob/main/public/images/logo.png?raw=true" width="200" alt="Idea project Logo"></a></p>

# Laravel Project - Idea

I have been a PHP developer for 5 years, working initially with WordPress sites and more recently in a Full Stack development role using the CodeIgniter framework.

Laravel has emerged as a popular framework, with developers in high demand. In recent months, I decided to learn about the Laravel framework in my spare time, primary using the [documentation](https://laravel.com/docs), [YouTube](https://www.youtube.com/) tutorials and [Laracasts](https://laracasts.com/).

This project is my first full build, and originates from the [Laravel From Scratch 2026](https://laracasts.com/series/laravel-from-scratch-2026) tutorial series on [Laracasts](https://laracasts.com/), taught by the excellent [Jeffrey Way](https://laracasts.com/@JeffreyWay).

Users also have the ability to update their account details.

I have hosted the finished project on my VPS, which you can access [here](https://idea.thewebleg.co.uk/). Feel free to [register an account](https://idea.thewebleg.co.uk/register), then explore the site.

## What's the big 'Idea'?

The project is a simple web app, where users must register for an account, sign in and create ideas.

Each idea **must** have a title and status. They **can** also have a description, featured image, actionable steps (multiple), and links (multiple).

There is full CRUD functionality for ideas. Users can only view, update and delete their own ideas.

## The build

- [Laravel](https://laravel.com/docs/13.x): This project was built (in VSCode) with the Laravel framework (v13.1.1) via [Laravel Herd](https://herd.laravel.com/), using many of its built-in tools such as artisan, tinker, and database migrations. The frontend views are built using blade templates.
- [TailWind CSS](https://tailwindcss.com/): Installed using Vite, TailWind (v4) provides a vast library of CSS styling (via classes) for this project.
- [Alpine JS](https://alpinejs.dev/): This lightweight JS library was used to add dynamic elements to the project, in particular for adding multiple actionable steps and links.
- [Font Awesome](https://fontawesome.com/): The tutorial I followed had a wide variety of icons imported into it which I did not have access to, so instead I used the free icons available at Font Awesome (v7.2).
- [Rector](https://github.com/rectorphp/rector): I used rector to refactor my PHP code.

## Bug fixes

- Updating an idea with changed links doesn't seem to save correctly.
- If an create or update fails, there is no warning notification, this occurs particularly when an invalid image is uploaded as a featured image.
- Favicon isn't showing on all pages.
- Check/Test emails are issued as expected i.e. when a user changes their email address, the old email address should be notified via email.

## Future improvements

- If editing an idea fails, can we open the modal on reload?
- Allow users to collaborate on ideas together, either by through share functionality or a company level grouping.
- Add some padding below the ideas.
- Add a footer.
