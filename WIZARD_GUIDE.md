# Form.io Wizard Mode Implementation Guide

## Overview
This enhanced form builder now supports both **Standard Forms** and **Wizard (Multi-Step) Forms** with real-time live preview functionality.

## Features Implemented

### 🎯 Dual Mode Support
- **Standard Form**: Single-page form with all fields visible at once
- **Wizard Mode**: Multi-step form with navigation controls between pages

### 👁️ Live Preview
- Real-time preview updates as you build your form
- Shows exactly how users will see the form
- Preview includes proper wizard navigation for multi-step forms

### 🔧 Enhanced Builder Interface
- Side-by-side builder and preview layout
- Easy switching between form types with quick action buttons
- Visual indicators showing current form mode

## How to Use Wizard Mode

### 1. Creating a Wizard Form

1. **Access the Form Builder**: Go to `/admin/form-builder`
2. **Select Wizard Mode**: 
   - Use the dropdown: "Form Display Type" → "Wizard (Multi-Step)"
   - OR click the "Wizard" button in the builder toolbar
3. **Build Your Wizard Pages**:
   - From the **Layout** section, drag **Panel** components to create wizard pages
   - Each Panel component becomes a separate step in your wizard
   - Add form fields inside each Panel

### 2. Wizard Structure
```
Wizard Form
├── Panel 1 (Page 1) - "Personal Information"
│   ├── Text Field - First Name
│   ├── Text Field - Last Name
│   └── Email Field
├── Panel 2 (Page 2) - "Address Details"
│   ├── Text Field - Street Address
│   ├── Text Field - City
│   └── Text Field - Postal Code
└── Panel 3 (Page 3) - "Preferences"
    ├── Select Box - Country
    └── Checkbox - Newsletter Subscription
```

### 3. Key Components for Wizards

- **Panel Component** (Layout section): Creates wizard pages
- **Button Component**: Can be used for custom navigation
- **Submit Button**: Automatically appears on the final page

### 4. Best Practices

1. **Organize Logically**: Group related fields into meaningful steps
2. **Panel Titles**: Use descriptive titles for each Panel (becomes step title)
3. **Field Validation**: Set up proper validation to prevent users from proceeding with invalid data
4. **Progress Indication**: The wizard automatically shows progress

## Interface Guide

### Builder Toolbar
- **Form Button** (Blue): Switch to standard single-page form
- **Wizard Button** (Purple): Switch to multi-step wizard mode

### Live Preview Features
- **Automatic Updates**: Preview refreshes as you make changes
- **Navigation Testing**: Test wizard navigation in preview
- **Visual Feedback**: Different styling for wizard vs. form mode
- **Mode Indicator**: Badge shows current form type (Form/Wizard)

## Technical Implementation

### Display Types
- `display: "form"` - Standard single-page form
- `display: "wizard"` - Multi-step wizard form

### Schema Structure
The form schema includes the display type and is stored as JSON:
```json
{
  "display": "wizard",
  "components": [
    {
      "type": "panel",
      "title": "Step 1",
      "key": "step1",
      "components": [
        // Step 1 fields here
      ]
    },
    {
      "type": "panel", 
      "title": "Step 2",
      "key": "step2",
      "components": [
        // Step 2 fields here
      ]
    }
  ]
}
```

## Navigation Controls

### Wizard Navigation
- **Next Button**: Proceeds to next step (with validation)
- **Previous Button**: Returns to previous step
- **Submit Button**: Appears only on final step
- **Step Indicators**: Shows current step and progress

### Validation
- Each step validates before allowing navigation to next step
- Invalid fields prevent progression
- Error messages display clearly

## Troubleshooting

### Common Issues

1. **Wizard not showing multiple pages**
   - Ensure you're using Panel components from the Layout section
   - Each Panel becomes a separate wizard page

2. **Preview not updating**
   - Check browser console for JavaScript errors
   - Refresh the page if preview gets stuck

3. **Navigation not working**
   - Verify form is in wizard mode (display: "wizard")
   - Check that Panel components are properly configured

### Debug Information
- Browser console shows navigation events
- Preview errors are displayed with helpful messages
- Form schema is logged for debugging

## Integration with Existing Features

- **Form Storage**: Wizard forms are stored the same way as standard forms
- **Submissions**: Work identically for both form types
- **User Experience**: Users see proper wizard interface when filling forms
- **Admin Management**: Same admin interface for managing all form types

## Example Wizard Use Cases

1. **User Registration**: Personal Info → Account Details → Preferences
2. **Job Application**: Basic Info → Experience → Documents → Review
3. **Survey Forms**: Demographics → Questions Set 1 → Questions Set 2 → Submit
4. **Order Process**: Products → Shipping → Payment → Confirmation
5. **Onboarding**: Welcome → Profile Setup → Settings → Complete

## Advanced Features

- **Conditional Logic**: Steps can be shown/hidden based on previous answers
- **Progress Bar**: Visual indication of completion progress  
- **Data Persistence**: Wizard maintains data across steps
- **Custom Styling**: Appearance can be customized via CSS

---

## Getting Started Quickly

1. Visit `/admin/form-builder`
2. Click the **"Wizard"** button
3. Drag a **Panel** from Layout section
4. Add fields inside the Panel
5. Add another Panel for the next step
6. Watch the live preview update in real-time!

The wizard implementation follows Form.io standards and provides a professional multi-step form experience for your users.