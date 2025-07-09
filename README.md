# Menucko - Weekly Menu Planner

<p align="center">
  <img src="/assets/images/favicon-gopher.svg?text=Menucko" alt="Menucko Logo" width="100"/>
</p>

Menucko is a Symfony-based web application for managing recipes and automatically generating weekly meal plans. The application alternates between meat and vegetarian dishes throughout the week and can generate a PDF of the weekly menu.

## Features

- **Recipe Management**: Add and view recipes categorized by type (meat or vegetarian)
- **Automatic Menu Generation**: Create balanced weekly menus with alternating meat and vegetarian dishes
- **PDF Export**: Download the weekly menu as a PDF document
- **Menu Regeneration**: Easily regenerate a new menu with different recipes

## Technologies Used

- **PHP 8.2+**
- **Symfony 7.2**: Modern PHP framework for web applications
- **Doctrine ORM**: Database abstraction layer and ORM
- **PostgreSQL**: Database for storing recipe information
- **Twig**: Template engine for rendering views
- **TCPDF**: Library for generating PDF documents
- **Docker**: Containerization for easy deployment

## Project Structure

- `src/Controller/`: Contains controllers for handling HTTP requests
  - `MenuController.php`: Handles menu display and generation
  - `ReceptyController.php`: Manages recipe creation and listing
- `src/Entity/`: Contains Doctrine entities
  - `Recept.php`: Represents a recipe with properties like title, category, and days
- `src/Service/`: Contains business logic
  - `MenuService.php`: Handles menu generation and PDF creation
- `templates/`: Contains Twig templates for rendering views
  - `menu/`: Templates for menu display
  - `recepty/`: Templates for recipe management

## Installation

### Prerequisites

- PHP 8.2 or higher
- Composer
- Docker and Docker Compose (optional, for containerized setup)
- PostgreSQL (if not using Docker)

### Steps

1. Clone the repository:
   ```bash
   git clone https://github.com/yourusername/menucko-symfony.git
   cd menucko-symfony
   ```

2. Install dependencies:
   ```bash
   composer install
   ```

3. Configure environment variables:
   ```bash
   cp .env .env.local
   ```
   Edit `.env.local` to set your database credentials and other configuration.

4. Start the database (using Docker):
   ```bash
   docker-compose up -d database
   ```
   Or configure your local PostgreSQL instance.

5. Create the database schema:
   ```bash
   php bin/console doctrine:database:create
   php bin/console doctrine:migrations:migrate
   ```

6. Start the Symfony development server:
   ```bash
   symfony server:start
   ```
   Or configure a web server of your choice.

## Usage

1. **Adding Recipes**:
   - Navigate to `/recepty/add`
   - Fill in the recipe details (title, category, type, days)
   - Submit the form to add the recipe

2. **Viewing Recipes**:
   - Navigate to `/recepty` to see all recipes grouped by category and type

3. **Generating a Weekly Menu**:
   - Navigate to `/menu` to see the current weekly menu
   - Click on the regenerate button to create a new menu

4. **Downloading the Menu as PDF**:
   - Navigate to `/menu`
   - Click on the PDF download button to get a printable version of the menu

## License

This project is licensed under the proprietary license - see the LICENSE file for details.