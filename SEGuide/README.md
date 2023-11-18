# Software Engineer's Guide 1.0

Last Updated by: JA Cereno


Last Updated on: November 11, 2023

### Built With
#### Backend
##### Programming Language & Framework
* PHP
  * Laravel 10 Framework

##### Database
* MySQL 8.0.27
* [Entity Relationship Diagram](insertlinkhere)
* [Data Definition Langauage ](insertlinkhere) - SQL Scripts

#### Frontend
* Vue v3.3.7
* Typescript
* Tailwind UI Kit
* Tailwind CSS
* Tailwind Headless UI


### Prerequisites
What is needed to set up the dev environment. For instance, global dependencies or any other tools.

* [MySQL v8.0.27](#installing-mysql)
* [MySQL Workbench](#installing-mysql-workbench)
* [NodeJS LTS](#installing-nodejs)
* [Git](#installing-git)
* [Source Tree](https://www.sourcetreeapp.com/)
* Preferred IDE - [VSCode](https://code.visualstudio.com/download), [IntelliJ Community](https://www.jetbrains.com/idea/download/), etc.
* [Docker Desktop](#installing-docker)
  

#### Installing MySQL
1. Download the [MySQL Community Server](https://dev.mysql.com/downloads/mysql/) installer on your local machine
2. Select your OS and OS Version, `.dmg` for macOS and `.exe` for windows.
    ![image info](./images/mysql-version.png)
3. Run the installer and finish the installtion process.


#### Installing Docker
1. Download the [docker desktop](https://www.docker.com/products/docker-desktop) installer on your local machine.
2. Run the installer `.dmg` for macOS and `.exe` for windows.
3. Finish the installtion process.
   
   
#### Installing Git
1. To install git using homebrew, run the following command below on your terminal
    ```shell
    brew install git
    ```
2. Finish the installation process.
3. To verify the installation, run the following command below on your terminal
    ```shell
    git --version
    ```
    ![image info](./images/git-verify.png)


### Setting up Dev
What is needed to set up the dev environment. For instance, global dependencies or any other tools. include download links.
#### Setup on Source Tree
1. Create a bitbucket folder for **hackathon-voting-system** repository on your local machine
2. Login to your Bitbucket account and go to [hackathon-voting-system](https://github.com/JACodeIT/hackathon-voting-system) repository
3. Click the clone button


#### Running the UI using CLI

1. Go to project root folder `/frontend`
    ```shell
    cd /frontend
    ```
2. Download the dependencies
    ```shell
    npm install
    ```
3. Run the service
    ```shell
    npm run start
    ```
4. Web UI Service will run in http://localhost:3000

#### Running the Backend Services using CLI

1. Go to project folder `/backend` ex. `/backend`
    ```shell
    cd /backend
    ```
2. Run Composer install
    ```shell
    composer install
    ```
3. Make a local copy of .env
    ```shell
    cp .env.example .env
    ```
4. Update DB credentials
    ```.env
        DB_CONNECTION=mysql
        DB_HOST=hackvote_db
        DB_PORT=3306
        DB_DATABASE=hackvote_db
        DB_USERNAME=root
        DB_PASSWORD=root
    ```
5. Run Docker Compose Build and Up
    ```shell
    docker-compose build
    docker-compose up -d
    ```
6. Open Bash on docker to run php artisan commands
    ```shell
    docker-compose exec hackvote_app bash
    ```
2. Run the command below to generate a key
    ```shell
    php artisan key:generate
    ```
3. Migrate & Seed Database
    ```shell
    php artisan migrate:fresh --seed
    ```
5. Web UI Service will run in http://localhost:8000

### Who do I talk to? ###

* JA Cereno (FluffyBuddy)
* Jake Batucan (Oshi)
