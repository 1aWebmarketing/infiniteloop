# infiniteloop

Use this app to gather UserStories from inside your company. Let users upvote ideas and categories ideas by type and prio.

![image](https://raw.githubusercontent.com/1aWebmarketing/infiniteloop/refs/heads/main/Screenshots/Showcase-1.gif)

## What's inside?

- Create, Show, Update and Delete Projects
- Configure a base User Story for every project
- CRUD User Stories
- Set User Story type and priority
- Restrict access to @domain.tld users in .env
- Use /ai in comment to let chatGPT directly change/enrich User Story

## Registration Domain Control

Define your companies Email domain in your `.env` file to prevent external users to register to the platform.

## Installation

Checkout the repository and rename the `.env.example` to `.env`.

- Run `composer install`
- Run `npm install`
- Run `php artisan migrate` or `php artisan migrate:fresh --seed`

Missing parameters are marked with `*****`

### Naming Conventions

- Use camelCase for naming throughout the Laravel project.
- In `resources/views/{folders}`, use plural names when working with models like `Companies` or `Orders`. For example, the Media Library should remain singular as it represents a collection of media.
- Route names should also be plural for resources, e.g., `companies.index` or `companies.show`. For the company selector page, `company.select` is used.
- Admin routes use the `admin.` prefix.

### Change Documentation

All contributors are required to document their changes in the `CHANGELOG.md` file. Each entry should include:
- The version number being updated.
- A brief description of the change (e.g., added features, bug fixes, or breaking changes).
- The author or contributor's name (optional).

This ensures transparency and provides a clear history of the project's evolution. For guidance, follow the existing structure in the `CHANGELOG.md` file.

## Security Vulnerabilities

If you discover any security vulnerabilities within adfinity, feel free to PR or drop an email to infiniteloop@0x25.de.

## License

infiniteloop is open-source :-)
