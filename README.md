# Klopvaart Intranet

This repository contains the development environment and the WordPress theme for the [Klopvaart](http://www.klopvaart.nl) Intranet.

## Setup

- Download and install [Docker](https://www.docker.com/community-edition#/download)
- Clone this repo `git clone git@github.com:alexbuijs/knock-knock.git && cd knock-knock`
- Run `docker-compose up`
- Visit [http://localhost:8080](http://localhost:8080) for WordPress
- Visit [http://localhost:8081](http://localhost:8081) for phpMyAdmin
- Install plugins:
  + Advanced Custom Fields PRO
- Create new pages: 'Home', 'Agenda', 'Bewoners', 'Documentatie' and select the accompanying templates
- Set landing page: Instellingen -> Lezen -> Statische pagina -> Voorpagina: 'Home'
- (Klopvaart only) Setup menu structure: Weergave -> Menu's: 'Home', 'Agenda', 'Bewoners', 'Documentatie'