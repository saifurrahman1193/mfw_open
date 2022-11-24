
<img src="public/frontend/img/logo.png" align="right" height="100" width="100" >

## MFW (Medicine For World)

## Abstract
This applied project is a web based application using Laravel and MySQL that defines **Medicine E-Commerce**. Here foreign customers can communicate, ask for medicine prices and buy life saving medicines from bangladesh. Customers first have to register, confirm by email validation, search any product, price inquiry, then admin panels assign prices for customer, customer add that product to cart and place the order. Users will be notified both in websites and through email.


## Contents
- [MFW (Medicine For World)](#mfw-medicine-for-world)
- [Abstract](#abstract)
- [Contents](#contents)
- [Introduction](#introduction)
  - [Motivation](#motivation)
  - [Project Scope](#project-scope)
  - [Purpose](#purpose)
- [Development Methodology](#development-methodology)
  - [Process Model](#process-model)
    - [Unified Process](#unified-process)
  - [Diagrams](#diagrams)
    - [Use Case Diagram](#use-case-diagram)
    - [Activity Diagram](#activity-diagram)
    - [DFD Diagram (Data Flow)](#dfd-diagram-data-flow)
    - [Schema Design](#schema-design)
    - [Deployment Diagram](#deployment-diagram)
- [Tools](#tools)
  - [Hardware Requirements](#hardware-requirements)
  - [Software Requirements](#software-requirements)
    - [Prerequisites](#prerequisites)
- [Imeplementation](#imeplementation)
  - [Modules](#modules)
    - [Admin Panel](#admin-panel)
      - [Dashboard](#dashboard)
      - [Super Admin](#super-admin)
        - [Users](#users)
        - [Roles](#roles)
        - [Dashboard](#dashboard-1)
        - [Environment variables](#environment-variables)
        - [DB Automated backups](#db-automated-backups)
        - [Block list management](#block-list-management)
        - [Log management](#log-management)
      - [Customers](#customers)
        - [Customers](#customers-1)
        - [Product prices for users](#product-prices-for-users)
        - [Offer management](#offer-management)
      - [Generics](#generics)
        - [Generic Settings](#generic-settings)
        - [Generics](#generics-1)
        - [Generic Brands](#generic-brands)
        - [Generic Brand Prices](#generic-brand-prices)
        - [Add files](#add-files)
      - [Suppliers](#suppliers)
        - [Positions](#positions)
        - [Suppliers](#suppliers-1)
      - [Frontend](#frontend)
        - [New product slider](#new-product-slider)
        - [Best selling products slider](#best-selling-products-slider)
        - [main slider](#main-slider)
        - [Main navbar categories](#main-navbar-categories)
        - [Testimonial setups](#testimonial-setups)
        - [Testimonial client contact request](#testimonial-client-contact-request)
        - [Currency setup](#currency-setup)
        - [Top brand setup](#top-brand-setup)
        - [banner](#banner)
        - [SEO default](#seo-default)
        - [Social medias](#social-medias)
        - [Approve reviews](#approve-reviews)
        - [Contact with product reviews](#contact-with-product-reviews)
        - [Customer to admin contact messages](#customer-to-admin-contact-messages)
      - [Pages](#pages)
        - [Pages](#pages-1)
      - [Footer](#footer)
        - [Top of footer (3rd + 4th portion)](#top-of-footer-3rd--4th-portion)
        - [Portion 1](#portion-1)
        - [Portion 1 socials](#portion-1-socials)
        - [Portion 2 pages](#portion-2-pages)
        - [Portion 3 categories](#portion-3-categories)
        - [Portion 4](#portion-4)
        - [Portion 4 socials](#portion-4-socials)
        - [Bottom footer](#bottom-footer)
      - [Carts](#carts)
        - [Carts](#carts-1)
        - [Create manual cart](#create-manual-cart)
        - [Default reasons & solutions](#default-reasons--solutions)
        - [Mail settings](#mail-settings)
        - [Payment settings](#payment-settings)
        - [Delivery settings](#delivery-settings)
        - [Invoice settings](#invoice-settings)
        - [Proforma invoice settings](#proforma-invoice-settings)
      - [Reports](#reports)
        - [Case History](#case-history)
        - [Price inquiry report](#price-inquiry-report)
        - [Payment confirmation report](#payment-confirmation-report)
        - [All customers data report](#all-customers-data-report)
        - [Products report](#products-report)
        - [Uploading third party data report](#uploading-third-party-data-report)
      - [Blogs](#blogs)
        - [Blog Mangement](#blog-mangement)
  - [Features](#features)
- [Deployment](#deployment)
  - [Public domains](#public-domains)
  - [Running locally](#running-locally)
    - [Directory structure](#directory-structure)
  - [Server](#server)
- [Security in Software](#security-in-software)
  - [Client side validation](#client-side-validation)
  - [System Security](#system-security)
    - [Introduction](#introduction-1)
    - [Server side validation](#server-side-validation)
- [Limitations and Conclusion](#limitations-and-conclusion)
  - [Challanges](#challanges)
  - [Recommendations on Future Improvement](#recommendations-on-future-improvement)
- [Authors](#authors)
- [License](#license)





## Introduction
Every e-commerce company needs a web based applications to run the operation smoothly. Like that Medicine for world needed a web based platform and developed a fully customized e-commerce web application. To communicate with foreign customers and take orders in online and inform the customers all the updates of the orders. Such as- providing information where the parcel is located right now and when will be delivered. Giving customers all the auto generated online invoices. So that customers can have all the documents of the order.   



### Motivation
Medicine for world organization was doing this business and was making reports in excel, word. Actually it was a manual process and it took a lot of time to organize and find appropriate information at a glance. At that point, comany felt to develop a automated process where they can do it automatically without any hassle.  

### Project Scope
Using this project customers and organization can process all the work automatically in online. It saves a lot of time both parties. Both parties can have online legal documents of their activities. It has notifications systems for both in website and mail. It has multilingual feature. User can view in english, russuan, chinese language. It has multiple currency feature. User can order with their own currency. This project has that much flexibility. 

### Purpose
 Purpose of this project is to make it easier communication between customers and organization and reduce time waste. Making an automated system instead of an outdated manual system which no longer applicable for any parties.

<!-- ### Courses and goals -->





<!-- ## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes. See deployment for notes on how to deploy the project on a live system. -->




## Development Methodology

### Process Model

#### Unified Process
For developing a complex, long and ongoing project like this it needs a lower risk and certaintyand good process model too.  So, by understanding the consequences of the reasons, UnifiedProcess model is being selected for this project.  The purposes of selecting this model are it’sUse Case driven to capture the user requirements .  This model is incremental and iterativeand it resolves the project risks related with the requirements.


### Diagrams

Diagrams gives the overview of the project and help develop efficient, effective and correctdesigns,  particularly Object Oriented designs.  Diagrams are also gives an environment tocommunicate  clearly  with  project  stakeholders  (concerned  parties:   developers,  customer,etc).  UML diagrams are organized into two distinct groups:  structural diagrams and behav-ioral or interaction diagrams.

  1. Behavioral UML diagrams
     1. Use case diagram  
     2. Activity diagram
  2. Structural UML diagrams
     1. Class diagram
     2. Deployment diagram
  3. Data Flow diagram

#### Use Case Diagram

Use Case Diagram referred to as behavior diagrams used to describe a set of actions or eventsteps defining the interactions between a role(actor) and a system to achieve a goal. The main purpose of a use case diagram is to exhibit who interacts with the system, and the main goals they can achieve with it. In this project users are divided into several categories-

  1. Administrator
  2. Customer

<img src="documents/diagrams/usecase/1.png"  style="margin-bottom: 50px;" >



#### Activity Diagram
<img src="documents/diagrams/activity/1.png"  style="margin-bottom: 50px;" >


#### DFD Diagram (Data Flow)
<img src="documents/diagrams/dfd/1.png"  style="margin-bottom: 50px;" >
<img src="documents/diagrams/dfd/2.png"  style="margin-bottom: 50px;" >


#### Schema Design


#### Deployment Diagram




## Tools

### Hardware Requirements
  1. Any device like andriod, iOS, Laptop, Desktop with internet connection.


### Software Requirements



#### Prerequisites

1. **For server deployment**
    1. Putty
       1. SSH key
    2. Filezilla
    3. Redis
    4. git
    6. LAMP (Linux, Apache2, MySQL>=5.7, PHP>=7.3)
2. **For local Development**
    1. Visual Studio Code
    2. MySQL Workbench
    3. Firefox
        1. Firefox vue-dev-tool
        2. inspector
        3. console
    4. Postman
    5. Git
    6. Redis
    7. Xamp
3. **For Client**
   1. Any device with any web browser

| Built With            | Version       | Description                                               |
| --------------------- | ------------- | --------------------------------------------------------- |
| PHP                   | 7.3 (minimum) |                                                           |
| MySQL                 | 5.7 (minimum) | Database                                                  |
| Laravel               | 5.7           |                                                           |
| Redis                 |               | To improve performance and reducing db query loading time |
| Vue.js                | 2.6.12        |                                                           |
| Jquery                |               |                                                           |
| Ajax                  |               | api call                                                  |
| Axios                 | 0.21.1        | api call                                                  |
| Bootstrap             | 3.3.7         | advance pre stylings framework                            |
| Font Awesome          | 4.7.0         | icons                                                     |
| Simple Line icon      |               | icons                                                     |
| Owl Carousel          |               | slider                                                    |
| Tooltipster           | 4.2.6         | Mouse hover note                                          |
| Magnific Popup        |               | Image zoom                                                |
| DataTables bootstrap4 |               | Yajra datatable                                           |
| Select2               | 4.0.6-rc.0    | select searching                                          |
| **Laravel Plugins**   |               |                                                           |
| Intervention Image    |               | Image processing                                          |
| DomPDF                |               | PDF Generation                                            |
| Debugbar              |               | Laravel debugging                                         |
| stevebauman/location  |               | get user location                                         |
| ntwindia/ntwindia     |               | Number to word conversion                                 |









## Imeplementation
This projects has been divided into several modules to make the development of the projectis much more easier.  Such are -


### Modules

<!-- https://www.compart.com/en/unicode/search?q=control#characters -->
<!-- https://unicode-table.com/en/#basic-latin -->
<!-- https://emojiterra.com/ -->
<!-- https://home.unicode.org/ -->
| Modules                                |
| -------------------------------------- |
| 🟢 **Frontend Panel**    🟢              |
| Home                                   |
| Product List                           |
| Product Details                        |
| Order History                          |
| Contact                                |
| Sitemap                                |
| Login                                  |
| Register                               |
| Profile                                |
| Prescriptions                          |
| Notifications                          |
| How to order                           |
| ⛨⛨ **Admin Panel** ⛨⛨                  |
| Login                                  |
| Notifications                          |
| 🛂 **Super Admin**                      |
| Users                                  |
| Roles                                  |
| Dashboard                              |
| System Environment                     |
| DB Automated backups management        |
| Block list management                  |
| Log management                         |
| 🧍 **Customers**                        |
| Customers                              |
| Product Prices For Users               |
| Offer Management                       |
| ⚕️ **Generics**                         |
| Generic Settings                       |
| Generics                               |
| Generic Brands                         |
| Generic Brand Prices                   |
| Add Files                              |
| 🧍 **Suppliers**                        |
| Positions                              |
| Suppliers                              |
| 📺 **Frontend**                         |
| New Product Sliders                    |
| Best Selling Product Sliders           |
| Main SLider                            |
| Main Navbar Categories                 |
| Testimonial Setup                      |
| Testimonial Client Contact Requests    |
| Currency Setup                         |
| Top Brands Setup                       |
| Banner                                 |
| SEO Default                            |
| Social Medias                          |
| Approve Reviews                        |
| Contact with product reviewer requests |
| Customer to admin contacts             |
|                                        |
| 🗐  **Pages**                           |
| Pages                                  |
| **Footer**                             |
| Top of footer(3rd+4th portion)         |
| Portion 1                              |
| Portion 1 social                       |
| Portion 2 pages                        |
| Portion 3 categories                   |
| Portion 4                              |
| Portion 4 socials                      |
| Bottom Footer                          |
| 🛒 **Carts**                            |
| Carts                                  |
| Create Manual Cart                     |
| Default Reasons and solutions          |
| Mail Settings                          |
| Payment Settings                       |
| Delivery Settings                      |
| Invoice Settings                       |
| Proforma Invoice Settings              |
| 🕮  **Reports**                         |
| Case History                           |
| Price Inquiry Report                   |
| Payment Confirmation Report            |
| All Customers Data Report              |
| Product Report                         |
| Uploading Third Party Data             |
| ✍  **Blogs**                           |
| Blog Management                        |

#### Admin Panel
##### Dashboard
* Total customers
* Total orders
* Total sale
* Total genericbrands
* Total blog posts
* Total product reviews
* **Further implementations**
  * Recent orders
  * Avg. order frequency time
  * Sales by category
  * Sales by sub-category
  * Today's revenue chart
  * Best selling products
  * Lowest selling products
  * Page views


##### Super Admin
###### Users
Here add admin users and give role wise permission to individual user.

###### Roles
Here add admin roles and assign fixed modules to it.

###### Dashboard
* **Backups**
  * **storage backup delete:** delete existing storage backup to reduce server weight.
  *  **Download storage backup:** generate storage backup. then download options showed up. then download it.
  *  db backup delete
  *  db backup download
* **Notifications**
  * notifications settings
* **language Settings**
  * language settings

###### Environment variables
Here most protected password must be applied to access this page. This is most sensative page in admin panel. Please don't mess with it.

###### DB Automated backups
  In database a cronjob applied. Every fixed duration like- 1 hour or 30 minutes the cronjob will run automatically in the server end. Everyday 1 file will be generated. In month 30 file will be generated.

```
crontab -l
crontab -e

add this line to this file 
**for every 30 minutes**

*/30 * * * * cd /var/www/html && php artisan schedule:run
```
###### Block list management

All the blocks are seperate. Individually/seperately any blocks  can be  unblocked and with one click all blocks can be removed. 


| Blocks Area                                                     | blockTypeId |
| --------------------------------------------------------------- | ----------- |
| Customer to admin contact messages request form submit (F -> A) | 1           |
| Contact with product reviewer requests form submit (F -> A)     | 2           |
| Testimonial Client Contact Requests form submit (F -> A)        | 3           |


**Note:**   
- **blockTypeId** 
  - this is fixed and hardcoded
- **F -> A**
  - this is Frontend to admin form submit


###### Log management
Here super admin can view log reports.

##### Customers
###### Customers
Here customer list will be shown. Customers can be managed here.
###### Product prices for users
Here customers list will be shown and products prices can be assigned here for individual customers.
###### Offer management
Offers  can be edited here.

##### Generics
###### Generic Settings
###### Generics
###### Generic Brands
###### Generic Brand Prices
###### Add files

##### Suppliers
###### Positions
Manage positions here.
###### Suppliers
manage suppliers here





##### Frontend
###### New product slider
select products to show in product slider
###### Best selling products slider
select products to show in best selling product slider
###### main slider
Add main sliders
###### Main navbar categories
Manage main navbar categories
###### Testimonial setups
Manage testimonials
###### Testimonial client contact request
here testimonial client contact requests will be shown. Requester, testimonial client, testimonial information will be shown here. Send mail to requester options also added here.
###### Currency setup
Currency rates can be managed here. USD to any currency rate will be shown here.
###### Top brand setup
Top brands management
###### banner
Banner management
###### SEO default
SEO default information will be added here. 
###### Social medias
Social medias information added here
###### Approve reviews
All the reviews will be shown here. If the reviewer gives a review it will be shown here first. Then administrator approve or modify or delete the review. If approve then this review will be hown in frontend.
###### Contact with product reviews


###### Customer to admin contact messages
If in frontend a registered customer/guest sends a message to admin. Then the message will show up here. If registered customers sends a message then admin can get a notification in admin panel. Here admin can send mail against that request.  


##### Pages
###### Pages
Mange pages here. In frontend these dynamic pages Page title, meta keywords, meta description information can be managed here.

##### Footer
###### Top of footer (3rd + 4th portion)
###### Portion 1
###### Portion 1 socials
###### Portion 2 pages
###### Portion 3 categories
###### Portion 4
###### Portion 4 socials
###### Bottom footer
##### Carts
###### Carts
These are the approval steps in entire cart processes. 

| Stage                    | Conditions                                  |
| ------------------------ | ------------------------------------------- |
| created and pending      | ```$cart->isCartApproved==1```              |
| updated and pending      | ```$cart->updateCount>0 ```                 |
|                          | ```&& $cart->isCartApproved==1```           |
| Payment Receipt Uploaded | ```$cart->isCartApproved==2  ```            |
|                          | ```&& $cart->isPaymentReceiptUploaded==1``` |
| Approved                 | ```$cart->isCartApproved == 2```            |
| Rejected                 | ```$cart->isCartApproved == 3```            |
| Payment confirm          | ```$cart->isPaymentConfirm == 1```          |
| tracking number added    | ```$cart->isCartApproved==2  ```            |
|                          | ```&& $cart->isPaymentConfirm==1```         |
|                          | ```&& $cart->isTrackingAdded==1```          |
| order complete           | ```$cart->isCartApproved==2  ```            |
|                          | ```&& $cart->isPaymentConfirm==1 ```        |
|                          | ```&& $cart->isTrackingAdded==1 ```         |
|                          | ```&& cart->isDeliveryConfirmed==1```       |
| Delivery info added      | ```$cart->isCartApproved==2  ```            |
|                          | ```&& $cart->isPaymentConfirm==1  ```       |
|                          | ```&& $cart->isTrackingAdded==1 ```         |
|                          | ```&& $cart->isDeliveryInfoAdded==1```      |

**Tags:** carts, cart approvals, order complete, order delivery info, cart info, cart approval info, cart rejected, cart reject info, cart tracking numbers, order tracking number adding, cart payment confirm.

###### Create manual cart
Here an admin can create manual cart for a customer. 
###### Default reasons & solutions
###### Mail settings
This is main mail settings from where mail will go. Please be noted this is not main host mail. Only the sender. If you want to change host sender then you have to change in .env settings.

###### Payment settings
###### Delivery settings
###### Invoice settings
###### Proforma invoice settings

##### Reports
###### Case History
This is final report of carts.
###### Price inquiry report
###### Payment confirmation report
###### All customers data report
###### Products report
###### Uploading third party data report

##### Blogs
###### Blog Mangement
  here blog post crud. 



### Features

* Multi-Lingual
* Multiple Currency
* Admin Panel
* 1 click DB backup download
* 1 click Storage backup download
* Notifications
* SMTP Mail Sending
* Localization (get user registration country)
* Reports
* PDF Reports
* Users' role wise access control




## Deployment


### Public domains

* <a href="https://www.medicineforworld.com.bd/" target=_blank>www.medicineforworld.com.bd</a>
* <a href="https://www.medicinefor.world/" target=_blank>www.medicinefor.world</a>
* <a href="https://www.medicineforworld.cn" target=_blank>www.medicineforworld.cn</a>
* <a href="https://www.medicineforworld.org/" target=_blank>www.medicineforworld.org</a>


### Running locally


```
php artisan serve
localhost:8000

php artisan serve --port=8001
localhost:8001
```


#### Directory structure

| Directory                  | Description                                                    |
| -------------------------- | -------------------------------------------------------------- |
| /documents                 | to track all the notes and requirements of the project         |
| /resources/views/layouts   | backend layouts view files                                     |
| /resources/views/layouts_f | frontend layouts view files                                    |
| /public/uploads            | all the files will be uploaded dynamically                     |
| /app/Http/Controllers      | all controllers                                                |
| /app/Http/Middlewares      | all middlewares                                                |
| /app/Http/kernel.php       | registering all middlewares                                    |
| /app/Libraries             | all custom library files/helpers(helper functions)             |
| /routes/web.php            | all web routes                                                 |
| /routes/api.php            | all api routes                                                 |
| /bootstrap/cache/*         | all cache file contains here. Remove this if you get any error |
| /config/                   | all the config files here                                      |


### Server
* export mfw.sql from local environment
* import mfw.sql in server
* install **LAMP Stack** in server environment
* **Git clone** from repository
* **.env** file change
* **delete** /bootstrap/cache/*
* Use **Filezilla** 
* Run below commands using putty - 

<details >
<summary>Click to <b>Expand/Collapse commands</b></summary>

```
sudo apt update
sudo apt -y install apache2
sudo apt install php7.4-common php7.4-mysql php7.4-xml php7.4-xmlrpc php7.4-curl php7.4-gd php7.4-imagick php7.4-cli php7.4-dev php7.4-imap php7.4-mbstring php7.4-opcache php7.4-soap php7.4-zip php7.4-intl php7.4-fpm php7.4-tidy libapache2-mod-php7.4 -y
php --version

sudo apt-cache policy redis-server
sudo apt-get install redis-server
sudo apt-get update
sudo apt-get install build-essential tcl
redis-server

sudo service apache2 restart
sudo systemctl restart apache2
sudo systemctl restart redis.service
sudo apt install mysql-server


===========replace to 000-default.conf==============
path: /etc/apache2/sites-available/000-default.conf
DocumentRoot /var/www/html/public

<Directory /var/www/html/public>
    Options Indexes FollowSymLinks
    AllowOverride All
    Require all granted
</Directory>
===========replace to 000-default.conf==============

==========ufw=========
ufw allow "Apache Full"
ufw allow "Apache Secure"
ufw allow "Apache Secure"
ufw allow Apache
ufw allow 80
ufw allow 22
ufw allow 3306
ufw allow "Apache Full"
==========ufw=========

================git==================
git clone <clone url>
git add .
git commit -m <message>
================git==================

=================== move directory one step back =========================
mv * ../
=================== move directory one step back =========================


=================== remove cache =========================
/bootstrap/cache/*
=================== remove cache =========================


=================FILL Zilla=============
settings: Protocol: SFTP
Host: <host> port <22>
Logon Type: Key File
user: root <ubuntu user>
Browse:  ppk private file
Connect
=================FILL Zilla=============


==========permissions============

sudo chmod a+rwx app
sudo chmod a+rwx bootstrap
sudo chmod a+rwx config
sudo chmod a+rwx public
sudo chmod a+rwx resources
sudo chmod a+rwx routes
sudo chmod a+rwx storage
sudo chmod a+rwx vendor


sudo chown -R www-data app
sudo chown -R www-data bootstrap
sudo chown -R www-data config
sudo chown -R www-data public
sudo chown -R www-data resources
sudo chown -R www-data routes
sudo chown -R www-data storage
sudo chown -R www-data vendor
sudo chown -R www-data vendor

sudo chgrp -R www-data storage bootstrap/cache
sudo chmod -R ug+rwx storage bootstrap/cache

sudo a2enmod rewrite
service apache2 restart

sudo chmod -R ug+rwx public
sudo chown -R www-data public
sudo chmod a+rwx public
sudo chown -R 777 public

 sudo chown -R www-data:www-data public
sudo chgrp -R www-data storage public
sudo chmod -R ug+rwx storage public
chown -R www-data:www-data html/
chgrp -R www-data public
sudo chown root public
sudo chgrp root public
 sudo chown -R www-data:root public

sudo a2enmod rewrite
sudo a2enmod headers
service apache2 restart
sudo systemctl restart redis.service

sudo a2enmod headers

service apache2 restart




==========php.ini======================
/etc/php/7.3/apache2/php.ini
post_max_size = 8192M                                                                                                              
upload_max_filesize = 2000M
memory_limit = 4000M   

or
upload_max_filesize = 50M
memory_limit = 512M
max_input_time = -1
max_execution_time = 0
post_max_size = 100M

service apache2 restart
systemctl restart apache2
sudo systemctl restart redis.service
==========php.ini======================


==========permissions============

```
</details>


<details >
<summary>Click to <b>Expand/Collapse commands: Cronjob</b></summary>

```
crontab -l
crontab -e

add this line to this file 
**for every 30 minutes**

*/30 * * * * cd /var/www/html && php artisan schedule:run
*/15 * * * * service apache2 restart 
*/15 * * * * service redis restart
```

</details>



## Security in Software
System security refers to various validations on data in the form of checks and controls to avoid the system from failing.It is always important to ensure that only valid data is entered and only valid operations are performed on the system.The system employees two types of checks and controls:

### Client side validation
  1. Captcha added to client side validation

### System Security

#### Introduction
The protection of computer-based resources that includes hardware, software, data, procedures and people against unauthorized use is known as System Security. System Security can be divided into four related issues:
  1. Security
  2. Integrity
  3. Privacy
  4. Confidentiality




#### Server side validation
  1. primary key
  2. foreign key
  3. forms valid data checks
  4. 

## Limitations and Conclusion

### Challanges
* SEO
* Making dynamic for everything
* Mail spaming
* Digital Ocean Server Deployment
* Preventing hacker
  * registering submit without frontend form using
  * contact to admin send message submit without frontend form using
* Responsiveness (Safari, iPhone)
* Notification issue
* Theme configuring
* Medicine Searching



### Recommendations on Future Improvement
There is always room for improvements. In this software there are so many other functionalities to add and improve.
* Applying JavaScripts frameworks like - Vue.js or React.js
* Using Nuxt.js
* Applying NoSQL like - MongoDB
* Chat System
* Applying automatic testing like- Unit testing

<!-- ## FAQ -->


## Authors

* **Md. Saifur Rahman** - *Full project* - (https://github.com/saifuroracle) (https://www.linkedin.com/in/saifurjob/)
* **Masud Al-Imran** - *Partial project* - (https://github.com/masudalimran) 


## License
This project is licensed under the **Medicine For World License**  







<!-- 

## Running the tests

Explain how to run the automated tests for this system

## Break down into end to end tests

Explain what these tests test and why

```
Give an example
```

## And coding style tests

Explain what these tests test and why

```
Give an example
```

## Deployment

Add additional notes about how to deploy this on a live system

## Built With

* [Dropwizard](http://www.dropwizard.io/1.0.2/docs/) - The web framework used
* [Maven](https://maven.apache.org/) - Dependency Management
* [ROME](https://rometools.github.io/rome/) - Used to generate RSS Feeds

## Contributing

Please read [CONTRIBUTING.md](https://gist.github.com/PurpleBooth/b24679402957c63ec426) for details on our code of conduct, and the process for submitting pull requests to us.

## Versioning

We use [SemVer](http://semver.org/) for versioning. For the versions available, see the [tags on this repository](https://github.com/your/project/tags). 

## Authors

* **Billie Thompson** - *Initial work* - [PurpleBooth](https://github.com/PurpleBooth)

See also the list of [contributors](https://github.com/your/project/contributors) who participated in this project.

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details

## Acknowledgments

* Hat tip to anyone whose code was used
* Inspiration
* etc
 -->
