# Klopvaart Intranet

This repository contains the development environment and the WordPress theme for the [Klopvaart](http://intranet.klopvaart.nl) Intranet.

## Setup

### Prerequisites

- [Node.js](https://nodejs.org)
- [composer](https://getcomposer.org)
- [Docker](https://www.docker.com)

### Download and setup Wordpress
- Clone this repo `git clone git@github.com:alexbuijs/knock-knock.git && cd knock-knock`
- Run `cp env.example .env` and fill in values. The default is a good starting point for local development
- Run `docker-compose up`
- Visit [http://localhost:8080](http://localhost:8080) for WordPress
- Visit [http://localhost:8081](http://localhost:8081) for phpMyAdmin
- Create pages: 'Home', 'Agenda', 'Bewoners', 'Documentatie', 'Bewoner', 'Profiel'
- Set landing page: Instellingen -> Lezen -> Statische pagina -> Voorpagina: 'Home'

### Theme development

- Run `composer install && npm install`
- Run `npm run start`. This runs webpack with BrowserSync

### Build for production
- Run `npm run production`