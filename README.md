# 🔧 FormBuilder - Advanced Multi-Page Form Builder

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-10.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel">
  <img src="https://img.shields.io/badge/Form.io-Latest-28A745?style=for-the-badge" alt="Form.io">
  <img src="https://img.shields.io/badge/PHP-8.1+-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP">
  <img src="https://img.shields.io/badge/Bootstrap-5.3-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white" alt="Bootstrap">
  <img src="https://img.shields.io/badge/MySQL-8.0-4479A1?style=for-the-badge&logo=mysql&logoColor=white" alt="MySQL">
</p>

<p align="center">
  <strong>A powerful, intuitive form builder application that enables administrators to create sophisticated multi-page forms, surveys, and exams with an easy-to-use drag-and-drop interface.</strong>
</p>

---

## 🌟 **Key Features**

### 🎯 **For Administrators**
- **🎨 Visual Form Builder**: Drag-and-drop interface powered by Form.io
- **📑 Multi-Page Forms**: Create wizard-style forms with multiple steps
- **🔀 Dynamic Components**: Text fields, dropdowns, checkboxes, file uploads, and more
- **👁️ Live Preview**: Real-time preview while building forms
- **📊 Form Management**: Publish/unpublish, edit, delete forms
- **📈 Submission Analytics**: View and analyze form submissions
- **🔒 Role-Based Access**: Secure admin-only form creation area

### 👥 **For Users**
- **📋 Form Filling**: Clean, responsive form interface
- **📱 Mobile Friendly**: Works seamlessly on all devices
- **💾 Auto-Save**: Progress preservation in multi-step forms
- **✅ Real-time Validation**: Instant feedback on form inputs
- **📤 Secure Submissions**: Safe data handling and storage

---

## 🚀 **Application Workflow**

### 1. **Home Page** 🏠
- Welcoming landing page with modern design
- Easy navigation to login/register
- Overview of platform capabilities

### 2. **Authentication System** 🔐
- **Admin Login**: Access to form builder and management
- **User Login**: Access to published forms
- **Registration**: Simple user onboarding
- **Role Management**: Automatic role assignment

### 3. **Admin Dashboard** 👑
- **Create New Form**: Access to the drag-and-drop form builder
- **Form Controls**: Manage all created forms
- **View Submissions**: Analyze form responses and data
- **User Management**: Monitor user activities

### 4. **Form Builder Interface** 🎨
- **Component Library**: Rich set of form elements
- **Wizard Mode**: Multi-page form creation
- **Live Preview**: See forms as users will
- **Schema Export**: JSON-based form definitions

### 5. **User Experience** 👤
- **Available Forms**: Browse published forms
- **Form Completion**: Intuitive form filling experience
- **Progress Tracking**: Visual progress indicators
- **Submission Confirmation**: Success feedback

---

## 🛠 **Technology Stack**

| Category | Technology | Version | Purpose |
|----------|------------|---------|---------|
| **Backend** | Laravel | 10.x | Web framework & API |
| **Frontend** | Blade Templates | - | Server-side rendering |
| **UI Framework** | Bootstrap | 5.3 | Responsive design |
| **Form Engine** | Form.io | Latest | Dynamic form builder |
| **Database** | MySQL | 8.0+ | Data persistence |
| **Authentication** | Laravel Auth | - | User management |
| **Styling** | Custom CSS | - | Enhanced UI/UX |

---

## 📁 **Project Structure**

```
formio-app-test7/
├── app/
│   ├── Http/Controllers/
│   │   ├── AuthController.php          # Authentication logic
│   │   ├── FormController.php          # Form CRUD operations
│   │   ├── FormViewController.php      # User form viewing
│   │   ├── HomeController.php          # Dashboard logic
│   │   └── SubmissionController.php    # Submission management
│   ├── Models/
│   │   ├── User.php                    # User model with roles
│   │   ├── Form.php                    # Form schema storage
│   │   └── Submission.php              # Form submission data
│   └── Middleware/                     # Role-based access control
├── resources/
│   └── views/
│       ├── admin/                      # Admin interface
│       │   ├── dashboard.blade.php     # Admin dashboard
│       │   ├── form-builder.blade.php  # Form builder interface
│       │   ├── forms.blade.php         # Form management
│       │   └── submissions.blade.php   # Submission viewer
│       ├── user/                       # User interface
│       └── layouts/                    # Shared layouts
├── database/
│   └── migrations/
│       ├── create_forms_table.php      # Form storage schema
│       └── create_submissions_table.php # Submission storage
└── routes/
    └── web.php                         # Application routes
```

---

## 🗄️ **Database Schema**

### **Users Table**
```sql
- id (Primary Key)
- name (VARCHAR)
- email (VARCHAR, Unique)
- password (Hashed)
- role (ENUM: 'admin', 'user')
- created_at, updated_at
```

### **Forms Table**
```sql
- id (Primary Key)
- title (VARCHAR)
- description (TEXT, Nullable)
- schema (JSON) - Form.io schema
- status (ENUM: 'published', 'unpublished')
- created_by (Foreign Key → users.id)
- created_at, updated_at
```

### **Submissions Table**
```sql
- id (Primary Key)
- form_id (Foreign Key → forms.id)
- user_id (Foreign Key → users.id)
- form_data (JSON) - User responses
- submitted_at (TIMESTAMP)
- created_at, updated_at
```

---

## ⚡ **Quick Start Guide**

### **Prerequisites**
- PHP 8.1 or higher
- Composer
- Node.js & NPM
- MySQL 8.0+
- Web server (Apache/Nginx)

### **Installation Steps**

1. **Clone the Repository**
   ```bash
   git clone https://github.com/chethan7032/formio-integration-test7.git
   cd formio-integration-test7
   ```

2. **Install Dependencies**
   ```bash
   composer install
   npm install && npm run build
   ```

3. **Environment Setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Database Configuration**
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=formbuilder_db
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```

5. **Run Migrations**
   ```bash
   php artisan migrate
   ```

6. **Create Admin User** (Optional)
   ```bash
   php artisan tinker
   ```
   ```php
   User::create([
       'name' => 'Admin',
       'email' => 'admin@example.com',
       'password' => bcrypt('password'),
       'role' => 'admin'
   ]);
   ```

7. **Start Development Server**
   ```bash
   php artisan serve
   ```

8. **Access the Application**
   - Navigate to `http://localhost:8000`
   - Login with admin credentials to access the form builder

---

## 📱 **Application Screenshots & Workflow**

### 🏠 **Home Page**
- Modern landing page with gradient design
- Clear call-to-action buttons
- Responsive navigation bar

### 🔐 **Authentication**
- Clean login/register forms
- Role-based redirection
- Session management

### 👑 **Admin Dashboard**
```
Admin Dashboard Features:
├── 🎨 Create New Form
├── 🔧 Form Controls (CRUD)
└── 📊 View Submissions
```

### 🎨 **Form Builder Interface**
- **Component Palette**: Drag-and-drop form elements
- **Canvas Area**: Visual form construction
- **Live Preview**: Real-time form preview
- **Mode Switching**: Standard form ↔ Wizard mode

### 📋 **Form Management**
```
Form Controls:
├── 📝 Preview Forms
├── 🔄 Publish/Unpublish Toggle
├── ✏️ Edit Forms
└── 🗑️ Delete Forms
```

### 👥 **User Experience**
- **Form Listing**: Browse available published forms
- **Form Filling**: Intuitive multi-step process
- **Progress Tracking**: Visual step indicators
- **Data Submission**: Secure form data handling

### 📊 **Submission Management**
- **Data Overview**: Tabular submission display
- **JSON Viewer**: Raw submission data
- **Export Options**: Data export capabilities
- **User Tracking**: Submission attribution

---

## 🔧 **Advanced Features**

### **Form Builder Capabilities**
- ✅ **Multi-Page Wizards**: Step-by-step form progression
- ✅ **Conditional Logic**: Dynamic field showing/hiding
- ✅ **Field Validation**: Built-in and custom validators
- ✅ **File Uploads**: Document and image handling
- ✅ **Rich Components**: Date pickers, select boxes, text areas
- ✅ **Layout Options**: Columns, panels, and sections

### **Security Features**
- 🔒 **CSRF Protection**: Laravel CSRF middleware
- 🔒 **Role-Based Access**: Admin/User role separation
- 🔒 **Input Sanitization**: XSS protection
- 🔒 **SQL Injection Prevention**: Eloquent ORM protection
- 🔒 **Session Security**: Secure session handling

### **Performance Optimizations**
- ⚡ **CDN Integration**: Form.io served from CDN
- ⚡ **Lazy Loading**: Dynamic script loading
- ⚡ **Caching**: Laravel's built-in caching
- ⚡ **Database Indexing**: Optimized query performance

---

## 🛣️ **API Routes**

### **Web Routes**
```php
// Public Routes
GET  /                    # Home page
GET  /about              # About page
GET  /login              # Login form
POST /login              # Login processing
GET  /register           # Registration form
POST /register           # Registration processing

// Admin Routes (auth + isAdmin middleware)
GET  /admin/dashboard           # Admin dashboard
GET  /admin/form-builder       # Form builder interface
POST /admin/forms              # Create new form
GET  /admin/forms              # List all forms
GET  /admin/forms/{id}         # Preview form
PATCH /admin/forms/{id}/toggle # Publish/unpublish
DELETE /admin/forms/{id}       # Delete form
GET  /admin/submissions        # View submissions

// User Routes (auth + isUser middleware)
GET  /user/forms         # Available forms
GET  /form/{id}          # Fill specific form
POST /form/{id}/submit   # Submit form data
```

---

## 🎯 **Use Cases**

### **Educational Institutions**
- 📚 **Student Surveys**: Feedback and evaluation forms
- 🎓 **Exam Creation**: Multi-step assessment forms
- 📝 **Application Forms**: Admission and registration
- 📊 **Research Surveys**: Data collection forms

### **Corporate Environment**
- 👥 **Employee Feedback**: HR surveys and evaluations
- 📋 **Client Onboarding**: Multi-step registration
- 💼 **Lead Generation**: Marketing and sales forms
- 🔄 **Process Applications**: Workflow automation

### **Healthcare & Services**
- 🏥 **Patient Intake**: Medical history collection
- 📅 **Appointment Booking**: Service scheduling
- 💊 **Health Surveys**: Wellness assessments
- 🔬 **Research Data**: Clinical trial forms

---

## 🤝 **Contributing**

We welcome contributions to improve FormBuilder! Here's how you can help:

### **Development Workflow**
1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

### **Areas for Contribution**
- 🐛 Bug fixes and improvements
- ✨ New form components
- 🎨 UI/UX enhancements
- 📚 Documentation updates
- 🔧 Performance optimizations

---

## 📞 **Support & Contact**

- **Developer**: Gandareddygari Chethanreddy
- **Email**: chethanreddy118@gmail.com
- **GitHub**: [@chethan7032](https://github.com/chethan7032)
- **Project Repository**: [formio-integration-test7](https://github.com/chethan7032/formio-integration-test7)

---

## 📄 **License**

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

---

## 🙏 **Acknowledgments**

- **Laravel Framework**: For the robust PHP foundation
- **Form.io**: For the powerful form building capabilities
- **Bootstrap**: For the responsive UI components
- **Community Contributors**: For ongoing support and feedback

---

<p align="center">
  <strong>Built with ❤️ for creating amazing forms and surveys</strong>
</p>

<p align="center">
  <img src="https://img.shields.io/github/stars/chethan7032/formio-integration-test7?style=social" alt="GitHub Stars">
  <img src="https://img.shields.io/github/forks/chethan7032/formio-integration-test7?style=social" alt="GitHub Forks">
</p>
