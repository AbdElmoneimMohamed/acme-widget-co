# Acme Widget Co Sales System

## Overview

This project is a proof of concept for Acme Widget Co's new sales system. The system is designed to manage a product catalog, handle basket operations with discounts and delivery charges, and apply special offers.

### Products

- **Red Widget (R01)**: $32.95
- **Green Widget (G01)**: $24.95
- **Blue Widget (B01)**: $7.95

### Delivery Charges

- Orders under $50: $4.95
- Orders under $90: $2.95
- Orders of $90 or more: Free

### Special Offers

- **Buy one Red Widget, get the second one at half price**
- **Buy two Green Widget, get the third for free**

## Features

- **Add Products to Basket:** Allows adding products to the basket by product code.
- **Calculate Total:** Computes the total cost of the basket, applying delivery charges and offers.

## Installation

1. **Clone the Repository**

   ```bash
   git clone https://github.com/AbdElmoneimMohamed/acme-widget-co.git
   cd acme-widget-co
   make local-setup

## Usage

| Command            | Meaning                                            |
|--------------------|----------------------------------------------------|
| `make local-setup` | setup local environment in one step for first time |
| `make test`        | run unitTest                                       | 
| `make ecs`         | run cs-fixer                                       |
| `make phpstan`     | run php-stan                                       |
| `make rector`      | run rector                                         |
| `make ci`          | run all Quality tools  
| `make start`       | start docker sail                                  |
| `make stop`        | stop docker                                        |
| `make rebuild`     | rebuild without cache                              |
| `make restart`     | restart docker                                     |
| `make migrate`     | run migration                                      |
                            |
| `make clear`       | clear cache                                        |


    
