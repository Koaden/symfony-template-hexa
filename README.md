# Symfony *7.4.3 (LTS)* template - hexagonal architecture

This template provides you to quickly start a Symfony project setup with an hexagonal architecture running with docker compose and a MySQL database.
A makefile is also ready to use for basic Symfony interractions.
The docker setup provides a dev and a prod configuration.

## Requirements

- [Docker](https://docs.docker.com/engine/install/)
- [Docker compose](https://docs.docker.com/compose/install/)

## Quick start

1. **Clone this repository**
    ```bash
   git clone https://github.com/Koaden/symfony-template.git my-project
2. Remove `.git` folder
3. Duplicate `.env.dist` and rename it `.env`
4. Prepare your project for GitHub
    ```bash
    git init my-project
5. Update this `README.md` to match your project
6. Make your first commit on the `main` branch 
    ```bash
    git commit -m "chore: init"
    git push