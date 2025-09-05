# 🍕 Food Order & Delivery System

<div align="center">

![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-005C84?style=for-the-badge&logo=mysql&logoColor=white)
![HTML5](https://img.shields.io/badge/HTML5-E34F26?style=for-the-badge&logo=html5&logoColor=white)
![CSS3](https://img.shields.io/badge/CSS3-1572B6?style=for-the-badge&logo=css3&logoColor=white)
![JavaScript](https://img.shields.io/badge/JavaScript-323330?style=for-the-badge&logo=javascript&logoColor=F7DF1E)

**A modern, responsive web application for restaurant food ordering with comprehensive admin management**

[🚀 Live Demo](#) • [📖 Documentation](#installation) • [🐛 Report Bug](#contributing) • [💡 Request Feature](#contributing)

</div>

---

## ✨ Features

### 🛍️ **Customer Experience**
- 🔍 **Smart Search** - Find your favorite dishes instantly
- 📱 **Responsive Design** - Perfect on mobile, tablet, and desktop
- 🍽️ **Browse Categories** - Organized food categories for easy navigation
- 🛒 **Easy Ordering** - Simple and intuitive order placement
- 📋 **Order Details** - Complete order form with delivery information

### 🔧 **Admin Dashboard**
- 📊 **Analytics Dashboard** - Real-time statistics and revenue tracking
- 👥 **User Management** - Add, update, delete admin accounts
- 🏷️ **Category Management** - Organize food items with image uploads
- 🍕 **Food Management** - Complete CRUD operations for menu items
- 📦 **Order Management** - Track and update order status
- 🔐 **Secure Authentication** - Session-based admin access control

### 🛡️ **Security & Performance**
- ✅ Input validation and sanitization
- 🔒 Prepared statements for database queries
- 🖼️ Safe image upload with auto-renaming
- 🚀 Optimized database queries
- 📱 Mobile-first responsive design

---

## 🖼️ Screenshots

<div align="center">

| Homepage | Admin Dashboard |
|----------|-----------------|
| ![Homepage](https://via.placeholder.com/400x250?text=Homepage+Preview) | ![Dashboard](https://via.placeholder.com/400x250?text=Admin+Dashboard) |

| Food Menu | Order Management |
|-----------|------------------|
| ![Menu](https://via.placeholder.com/400x250?text=Food+Menu) | ![Orders](https://via.placeholder.com/400x250?text=Order+Management) |

</div>

---

## 🚀 Quick Start

### Prerequisites
- 🔧 **XAMPP/WAMP/LAMP** - Local server environment
- 🐘 **PHP 7.4+** - Server-side scripting
- 🗄️ **MySQL 5.7+** - Database management
- 🌐 **Modern Web Browser** - Chrome, Firefox, Safari, Edge

### ⚡ Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/amaan-ur-raheman/food-ordering-system.git
   cd food-ordering-system
   ```

2. **Setup Database**
   ```sql
   CREATE DATABASE food_order;
   ```
   
3. **Import Database Schema**
   ```sql
   -- Create required tables
   CREATE TABLE admin (
       id INT PRIMARY KEY AUTO_INCREMENT,
       full_name VARCHAR(100) NOT NULL,
       username VARCHAR(100) UNIQUE NOT NULL,
       password VARCHAR(255) NOT NULL
   );
   
   CREATE TABLE category (
       id INT PRIMARY KEY AUTO_INCREMENT,
       title VARCHAR(100) NOT NULL,
       image_name VARCHAR(255),
       featured VARCHAR(10) DEFAULT 'No',
       active VARCHAR(10) DEFAULT 'Yes'
   );
   
   CREATE TABLE food (
       id INT PRIMARY KEY AUTO_INCREMENT,
       title VARCHAR(100) NOT NULL,
       description TEXT,
       price DECIMAL(10,2) NOT NULL,
       image_name VARCHAR(255),
       category_id INT,
       featured VARCHAR(10) DEFAULT 'No',
       active VARCHAR(10) DEFAULT 'Yes',
       FOREIGN KEY (category_id) REFERENCES category(id)
   );
   
   CREATE TABLE `order` (
       id INT PRIMARY KEY AUTO_INCREMENT,
       food VARCHAR(150) NOT NULL,
       price DECIMAL(10,2) NOT NULL,
       qty INT NOT NULL,
       total DECIMAL(10,2) NOT NULL,
       order_date DATETIME DEFAULT CURRENT_TIMESTAMP,
       status VARCHAR(50) DEFAULT 'Ordered',
       customer_name VARCHAR(150) NOT NULL,
       customer_contact VARCHAR(20) NOT NULL,
       customer_email VARCHAR(150),
       customer_address TEXT NOT NULL
   );
   ```

4. **Configure Database Connection**
   ```php
   // Update config/constants.php
   define('SITEURL', 'http://localhost/Food-Order-System/');
   define('DB_NAME', 'food_order');
   ```

5. **Access the Application**
   - 🌐 **Frontend:** `http://localhost/Food-Order-System/`
   - 🔐 **Admin Panel:** `http://localhost/Food-Order-System/admin/login.php`

---

## 🔐 Admin Access

<div align="center">

### 🎯 **Default Admin Credentials**

| Field | Value |
|-------|-------|
| **Username** | `admin` |
| **Password** | `admin123` |
| **Login URL** | `http://localhost/Food-Order-System/admin/login.php` |

</div>

> ⚠️ **Security Note:** Change the default password after first login for production use.

---

## 📁 Project Structure

```
Food-Order-System/
├── 🏠 Frontend Pages
│   ├── index.php              # Homepage with featured items
│   ├── categories.php         # Browse all categories
│   ├── foods.php             # Browse all foods
│   ├── category-foods.php    # Foods by category
│   ├── food-search.php       # Search results
│   └── order.php             # Order placement
│
├── 🔧 Admin Panel
│   ├── index.php             # Dashboard with analytics
│   ├── login.php             # Admin authentication
│   ├── manage-*.php          # CRUD operations
│   ├── add-*.php             # Create new records
│   ├── update-*.php          # Edit existing records
│   ├── delete-*.php          # Remove records
│   └── Partials/             # Reusable components
│
├── ⚙️ Configuration
│   └── config/constants.php   # Database & site settings
│
├── 🎨 Assets
│   ├── css/style.css         # Frontend styling
│   ├── admin/admin.css       # Admin panel styling
│   └── images/               # Uploaded images
│
└── 🧩 Components
    └── partials-front/       # Frontend components
```

---

## 🛠️ Technology Stack

<div align="center">

| Layer | Technology | Purpose |
|-------|------------|---------|
| **Frontend** | HTML5, CSS3, JavaScript | User interface and interactions |
| **Backend** | PHP 7.4+ | Server-side logic and processing |
| **Database** | MySQL 5.7+ | Data storage and management |
| **Server** | Apache/Nginx | Web server environment |
| **Development** | XAMPP/WAMP | Local development environment |

</div>

---

## 🎯 Usage Guide

### 👤 **For Customers**
1. 🏠 Browse the homepage for featured categories and foods
2. 🔍 Use the search bar to find specific dishes
3. 📂 Navigate through categories to explore menu
4. 🛒 Click "Order Now" on any food item
5. 📝 Fill out the order form with delivery details
6. ✅ Submit your order

### 👨‍💼 **For Administrators**
1. 🔐 Login to admin panel with credentials
2. 📊 View dashboard statistics and analytics
3. 🏷️ Manage food categories (add/edit/delete)
4. 🍕 Manage food items with images and pricing
5. 📦 Track and update customer orders
6. 👥 Manage admin user accounts

---

## 🔧 Customization

### 🎨 **Branding**
- Replace `images/logo.png` with your restaurant logo
- Update colors in `css/style.css` and `admin/admin.css`
- Modify social media links in `partials-front/footer.php`

### 🌐 **Configuration**
- Update site URL in `config/constants.php`
- Modify database credentials as needed
- Customize email settings for notifications

---

## 🤝 Contributing

We welcome contributions! Here's how you can help:

1. 🍴 **Fork** the repository
2. 🌿 **Create** a feature branch (`git checkout -b feature/AmazingFeature`)
3. 💾 **Commit** your changes (`git commit -m 'Add some AmazingFeature'`)
4. 📤 **Push** to the branch (`git push origin feature/AmazingFeature`)
5. 🔄 **Open** a Pull Request

### 🐛 **Bug Reports**
Found a bug? Please open an issue with:
- 📝 Detailed description
- 🔄 Steps to reproduce
- 🖥️ Environment details
- 📸 Screenshots (if applicable)

---

## 👨‍💻 Author

<div align="center">

| Developer | Role | GitHub |
|-----------|------|--------|
| **Amaan Ur Raheman** | Full Stack Developer | [@amaan-ur-raheman](https://github.com/amaan-ur-raheman) |

</div>

---

## 📄 License

This project is licensed under the **MIT License** - see the [LICENSE](LICENSE) file for details.

---

## 🙏 Acknowledgments

- 🎨 Icons by [Icons8](https://icons8.com)
- 📸 Images from [Unsplash](https://unsplash.com)
- 💡 Inspiration from modern food delivery platforms
- 🚀 Built with passion for learning and sharing

---

<div align="center">

### 🌟 **Star this repository if you found it helpful!**

**Made with ❤️ by the development team**

[⬆ Back to Top](#-food-order--delivery-system)

</div>
