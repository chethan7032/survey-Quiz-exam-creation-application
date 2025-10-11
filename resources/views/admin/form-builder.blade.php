@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-md-12">

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="card shadow">
                <div class="card-header bg-primary text-white fw-bold">
                    🧱 Drag & Drop Form Builder
                </div>
                <div class="card-body bg-light">
                    <form id="formBuilderForm" method="POST" action="{{ route('admin.forms.store') }}">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Form Title</label>
                            <input type="text" name="title" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Description (optional)</label>
                            <textarea name="description" class="form-control" rows="2"></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Form Display Type</label>
                            <select name="display" id="displayType" class="form-control">
                                <option value="form">Standard Form</option>
                                <option value="wizard">Wizard (Multi-Step)</option>
                            </select>
                        </div>

                        <input type="hidden" name="schema" id="formSchemaInput">

                        <!-- Form Builder Section -->
                        <div class="mb-4">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="text-primary mb-0">🔧 Form Builder</h5>
                                <div class="btn-group btn-group-sm" role="group">
                                    <button type="button" class="btn btn-outline-info" onclick="formBuilderHelpers.switchToForm()" title="Switch to Standard Form">
                                        <i class="fas fa-file-alt"></i> Form
                                    </button>
                                    <button type="button" class="btn btn-outline-purple" onclick="formBuilderHelpers.switchToWizard()" title="Switch to Wizard Mode">
                                        <i class="fas fa-magic"></i> Wizard
                                    </button>
                                </div>
                            </div>
                            
                            <div class="builder-section bg-white rounded border" id="builderContainer">
                                <div class="p-3" id="builder">
                                <div class="text-center py-5">
                                    <div class="spinner-border text-primary mb-3" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                    <p class="text-muted">Initializing Form Builder...</p>
                                    <small class="text-muted">If this takes too long, please refresh the page</small>
                                    <div class="mt-3">
                                        <button class="btn btn-sm btn-outline-primary" onclick="initializeApp()" style="display:none;" id="retryBtn">
                                            <i class="fas fa-redo"></i> Retry
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Live Preview Section -->
                        <div class="mb-4 mt-5">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="text-success mb-0">👁️ Live Preview</h5>
                                <small class="text-muted" id="previewMode">Standard Form Preview</small>
                            </div>
                            <div class="preview-section preview-container border" id="preview">
                                <div class="text-center text-muted py-5">
                                    <i class="fas fa-eye fa-3x mb-3"></i>
                                    <p>Start building your form to see the live preview here</p>
                                    <small class="text-info">Select components from the left panel and see them render here instantly</small>
                                </div>
                            </div>
                        </div>

                        <div class="alert alert-info mt-3">
                            <div class="row">
                                <div class="col-md-6">
                                    <h6><i class="fas fa-info-circle"></i> Standard Form</h6>
                                    <p class="mb-0 small">Single page form with all fields visible at once. Best for simple data collection.</p>
                                </div>
                                <div class="col-md-6">
                                    <h6><i class="fas fa-magic"></i> Wizard Mode</h6>
                                    <p class="mb-1 small">Multi-step form with navigation controls and page tabs.</p>
                                    <ul class="small mb-0 ps-3">
                                        <li>Use the <strong>"Add Page"</strong> button to create new wizard pages</li>
                                        <li>Each page is automatically created as a Panel component</li>
                                        <li>Click page tabs to switch between pages</li>
                                        <li>Drag components into each page panel</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-success px-4 py-2">💾 Save Form</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/formiojs@latest/dist/formio.full.min.css" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
<style>
    .preview-container {
        background: #f8f9fa;
        border-radius: 8px;
        overflow: hidden;
        position: relative;
    }
    .builder-section {
        height: 500px;
        overflow-y: auto;
    }
    .preview-section {
        height: 400px;
        overflow-y: auto;
    }
    .form-display-badge {
        position: absolute;
        top: 15px;
        right: 15px;
        z-index: 10;
        font-size: 0.8rem;
    }
    .wizard-preview .formio-form {
        padding: 20px;
        background: white;
        margin: 10px;
        border-radius: 6px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    .form-preview .formio-form {
        padding: 20px;
        background: white;
        margin: 10px;
        border-radius: 6px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    .btn-outline-purple {
        color: #6f42c1;
        border-color: #6f42c1;
    }
    .btn-outline-purple:hover {
        background-color: #6f42c1;
        border-color: #6f42c1;
        color: white;
    }
    .bg-purple {
        background-color: #6f42c1 !important;
    }
    .btn-purple {
        background-color: #6f42c1;
        border-color: #6f42c1;
        color: white;
    }
    .btn-purple:hover {
        background-color: #5a2d91;
        border-color: #5a2d91;
        color: white;
    }
    .builder-section {
        border-radius: 8px;
    }
    .preview-section {
        border-radius: 8px;
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    }
    
    /* Wizard specific styles */
    .wizard-preview .wizard-page {
        background: white;
        border-radius: 8px;
        margin: 10px;
        padding: 20px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    }
    
    .wizard-preview .btn-wizard {
        margin: 10px 5px;
    }
    
    /* Form.io component overrides for better preview */
    #preview .formio-component {
        margin-bottom: 1rem;
    }
    
    #preview .formio-component-submit {
        text-align: center;
        padding-top: 1rem;
    }
    
    /* Loading animation */
    .preview-loading {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 200px;
        flex-direction: column;
    }
    
    .spinner-border-sm {
        width: 2rem;
        height: 2rem;
    }
    
    /* Wizard Page Tabs */
    .wizard-page-tabs {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        border-bottom: 2px solid #dee2e6;
    }
    
    .page-tab {
        background: white;
        border: 1px solid #dee2e6;
        padding: 6px 14px;
        margin-right: 8px;
        border-radius: 6px;
        font-size: 0.875rem;
        font-weight: 500;
        transition: all 0.2s ease;
        position: relative;
    }
    
    .page-tab:hover {
        background: #e3f2fd;
        border-color: #2196f3;
        transform: translateY(-1px);
    }
    
    .page-tab.btn-primary {
        background: #007bff;
        border-color: #007bff;
        color: white;
        box-shadow: 0 2px 4px rgba(0,123,255,0.3);
    }
    
    #builderContainer {
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        transition: box-shadow 0.3s ease;
    }
    
    #builderContainer:hover {
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.15);
    }
    
    /* Wizard page panels in builder */
    .formio-component-panel {
        margin-bottom: 20px !important;
        border: 2px solid #e9ecef !important;
        border-radius: 8px !important;
        background: #f8f9fa !important;
    }
    
    .formio-component-panel .panel-title {
        background: linear-gradient(135deg, #007bff, #0056b3) !important;
        color: white !important;
        padding: 12px 16px !important;
        margin: 0 !important;
        border-radius: 6px 6px 0 0 !important;
        font-weight: 600 !important;
        font-size: 1rem !important;
    }
    
    .formio-component-panel .panel-body {
        padding: 20px !important;
        min-height: 100px !important;
        background: white !important;
        border-radius: 0 0 6px 6px !important;
    }
    
    .formio-component-panel .panel-body:empty::before {
        content: "📝 Drag components here to add to this page";
        display: block;
        text-align: center;
        color: #6c757d;
        font-style: italic;
        padding: 30px;
        border: 2px dashed #dee2e6;
        border-radius: 6px;
        background: #f8f9fa;
    }
    
    /* Force panels to be expanded and visible */
    .formio-component-panel .panel-collapse,
    .formio-component-panel .collapse {
        display: block !important;
        height: auto !important;
    }
    
    .formio-component-panel.collapsed {
        display: block !important;
    }
    
    /* Make panel drop zones more visible */
    .formio-component-panel .formio-component-content,
    .formio-component-panel .panel-body {
        min-height: 80px !important;
        border: 1px dashed #ccc !important;
        position: relative !important;
    }
    
    /* Panel headers should be clickable but always expanded */
    .formio-component-panel .panel-header {
        cursor: pointer;
        user-select: none;
    }
        border-radius: 5px;
        cursor: pointer;
        transition: all 0.2s;
        position: relative;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    
    .page-tab:hover {
        background: #e9ecef;
        border-color: #adb5bd;
    }
    
    .page-tab.active {
        background: #0d6efd;
        color: white;
        border-color: #0d6efd;
    }
    
    .page-tab.active:hover {
        background: #0b5ed7;
    }
    
    .page-tab .remove-page {
        background: none;
        border: none;
        color: #6c757d;
        font-size: 12px;
        padding: 2px 4px;
        border-radius: 3px;
        cursor: pointer;
        opacity: 0;
        transition: opacity 0.2s;
    }
    
    .page-tab:hover .remove-page {
        opacity: 1;
    }
    
    .page-tab.active .remove-page {
        color: rgba(255,255,255,0.8);
    }
    
    .page-tab .remove-page:hover {
        background: rgba(255,255,255,0.2);
        color: white;
    }
    
    .page-tabs-container {
        flex-wrap: wrap;
        gap: 5px;
    }
</style>
@endpush

@push('styles')
<link rel="stylesheet" href="https://cdn.form.io/formiojs/formio.full.min.css">
@endpush

@push('scripts')
<script>
// Load Form.io dynamically like your reference code
const formioCSS1 = document.createElement("link");
formioCSS1.rel = "stylesheet";
formioCSS1.href = "https://cdn.form.io/formiojs/formio.full.min.css";
document.head.appendChild(formioCSS1);

const formioScript1 = document.createElement("script");
formioScript1.src = "https://cdn.form.io/formiojs/formio.full.min.js";
formioScript1.onload = initializeFormBuilder;
document.body.appendChild(formioScript1);

let builderInstance = null;
let previewForm = null;
let currentDisplayMode = 'form';
let initialSchema = {};

console.log('Script loading...');

function initializeFormBuilder() {
    console.log('🚀 Initializing Form Builder...');
    
    if (typeof Formio === 'undefined') {
        console.error('❌ Formio not loaded');
        return;
    }

    const builderDiv = document.getElementById('builder');
    const previewDiv = document.getElementById('preview');
    const schemaInput = document.getElementById('formSchemaInput');
    const displaySelect = document.getElementById('displayType');

    if (!builderDiv || !previewDiv || !schemaInput) {
        console.error('❌ Required elements not found');
        return;
    }

    // Load existing schema if available
    try {
        if (schemaInput.value) {
            initialSchema = JSON.parse(schemaInput.value);
            currentDisplayMode = initialSchema.display || 'form';
        }
    } catch (e) {
        console.warn('⚠️ Invalid JSON in schema input:', e);
        initialSchema = {};
    }

    // Set initial display mode
    if (displaySelect) {
        displaySelect.value = currentDisplayMode;
        displaySelect.addEventListener('change', function() {
            currentDisplayMode = displaySelect.value;
            console.log('🔄 Display mode changed to:', currentDisplayMode);
            
            // Reset schema when switching modes
            if (currentDisplayMode === 'wizard') {
                initialSchema = {
                    display: 'wizard',
                    components: [
                        {
                            type: 'panel',
                            title: 'Page 1',
                            key: 'page1',
                            components: []
                        }
                    ]
                };
            } else {
                initialSchema = {
                    display: 'form',
                    components: []
                };
            }
            
            renderBuilder();
        });
    }

    renderBuilder();
}

function renderBuilder() {
    console.log('🔄 Rendering builder for mode:', currentDisplayMode);
    
    const builderDiv = document.getElementById('builder');
    builderDiv.innerHTML = '<div class="text-center py-4">Loading builder...</div>';

    // Destroy existing builder
    if (builderInstance && typeof builderInstance.destroy === 'function') {
        builderInstance.destroy(true);
        builderInstance = null;
    }

    // Use the initialSchema or create a default one
    let schema = initialSchema;
    if (!schema || Object.keys(schema).length === 0) {
        if (currentDisplayMode === 'wizard') {
            schema = {
                display: 'wizard',
                components: [
                    {
                        type: 'panel',
                        title: 'Page 1',
                        key: 'page1',
                        components: []
                    }
                ]
            };
        } else {
            schema = {
                display: 'form',
                components: []
            };
        }
    }

    console.log('📋 Using schema:', schema);

    // Create builder with proper wizard support
    Formio.builder(builderDiv, schema, {
        display: currentDisplayMode,
        noDefaultSubmitButton: true
    }).then(function(builder) {
        console.log('✅ Builder created successfully for mode:', currentDisplayMode);
        builderInstance = builder;

        // Inject custom wizard styles
        injectWizardStyles();

        // Listen for changes
        builderInstance.on('change', function(updatedSchema) {
            console.log('📝 Form schema changed');
            updatedSchema.display = currentDisplayMode;
            document.getElementById('formSchemaInput').value = JSON.stringify(updatedSchema, null, 2);
            renderPreview(updatedSchema);
        });

        // Initial render
        renderPreview(builderInstance.schema);

    }).catch(function(err) {
        console.error('❌ Builder error:', err);
        builderDiv.innerHTML = '<div class="alert alert-danger">Builder Error: ' + err.message + '</div>';
    });
}

function injectWizardStyles() {
    // Inject custom styles for better wizard visualization
    const style = document.createElement("style");
    style.textContent = `
        .wizard-pages {
            background-color: #f8f9fa;
            border-radius: 8px;
            padding: 10px 15px;
            margin-bottom: 1rem;
            display: flex;
            gap: 10px;
        }
        .wizard-page-label {
            font-size: 14px;
            font-weight: 500;
            padding: 6px 12px;
            border-radius: 20px;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .wizard-page-label.badge-primary {
            background-color: #007bff;
            color: #fff;
        }
        .wizard-page-label.badge-info {
            background-color: #17a2b8;
            color: white;
        }
        .wizard-page-label.badge-success {
            background-color: #28a745;
            color: white;
        }
        .wizard-page-label:hover {
            opacity: 0.85;
        }
        
        /* Enhanced wizard builder styles */
        .formio-component-panel.wizard-page {
            border: 2px solid #007bff;
            border-radius: 8px;
            margin-bottom: 15px;
        }
        
        .formio-component-panel .panel-title {
            background: #007bff;
            color: white;
            font-weight: bold;
            padding: 8px 15px;
            margin: 0;
            border-radius: 6px 6px 0 0;
        }
    `;
    document.head.appendChild(style);
}

function renderPreview(schema) {
    var previewDiv = document.getElementById('preview');
    previewDiv.innerHTML = '<div class="text-center py-4">Loading preview...</div>';

    if (!schema || !schema.components || schema.components.length === 0) {
        previewDiv.innerHTML = '<div class="text-center py-5 text-muted">Add components to see live preview</div>';
        return;
    }

    var options = schema.display === 'wizard' ? {} : { readOnly: true };

    Formio.createForm(previewDiv, schema, options)
        .then(function(form) {
            previewForm = form;
            console.log('✅ Preview rendered for mode:', schema.display);
        })
        .catch(function(err) {
            console.error('❌ Preview error:', err);
            previewDiv.innerHTML = '<div class="alert alert-warning">Preview Error: ' + err.message + '</div>';
        });
}

function switchToWizardMode() {
    console.log('🧙‍♂️ Switching to wizard mode');
    
    currentDisplayMode = 'wizard';
    document.getElementById('displayType').value = 'wizard';
    document.getElementById('previewMode').textContent = 'Wizard Preview';
    
    // Update button states
    updateModeButtons();
    
    // Rebuild with wizard mode - Form.io handles everything automatically
    renderBuilder();
}

function switchToFormMode() {
    console.log('📄 Switching to form mode');
    
    currentDisplayMode = 'form';
    document.getElementById('displayType').value = 'form';
    document.getElementById('previewMode').textContent = 'Standard Form Preview';
    
    // Update button states
    updateModeButtons();
    
    // Rebuild with form mode
    renderBuilder();
}

// Simplified helper function for wizard tips
function showWizardHelp() {
    var helpMessage = `
🧙‍♂️ WIZARD MODE HELP

📋 How to use Form.io Wizard Mode:

1️⃣ Switch to Wizard mode using the "🧙‍♂️ Wizard" button above

2️⃣ Form.io automatically creates the wizard structure with page navigation

3️⃣ You'll see page tabs (Page 1, Page 2, etc.) appear automatically in the builder

4️⃣ Drag components from the left into the builder area - Form.io handles the rest!

5️⃣ Use the Live Preview to see your multi-step wizard in action

💡 TIP: Form.io manages all the wizard functionality natively - just switch to wizard mode and start building!
    `;
    alert(helpMessage);
}

function updateModeButtons() {
    // Update the Form/Wizard toggle buttons to show active state
    var formBtn = document.querySelector('[onclick="formBuilderHelpers.switchToForm()"]');
    var wizardBtn = document.querySelector('[onclick="formBuilderHelpers.switchToWizard()"]');
    
    if (currentDisplayMode === 'wizard') {
        // Wizard mode active
        if (wizardBtn) {
            wizardBtn.classList.remove('btn-outline-purple');
            wizardBtn.classList.add('btn-purple');
            wizardBtn.style.background = '#6f42c1';
            wizardBtn.style.color = 'white';
            wizardBtn.style.borderColor = '#6f42c1';
        }
        
        if (formBtn) {
            formBtn.classList.remove('btn-info');
            formBtn.classList.add('btn-outline-info');
            formBtn.style.background = '';
            formBtn.style.color = '';
            formBtn.style.borderColor = '';
        }
    } else {
        // Form mode active
        if (formBtn) {
            formBtn.classList.remove('btn-outline-info');
            formBtn.classList.add('btn-info');
            formBtn.style.background = '#17a2b8';
            formBtn.style.color = 'white';
            formBtn.style.borderColor = '#17a2b8';
        }
        
        if (wizardBtn) {
            wizardBtn.classList.remove('btn-purple');
            wizardBtn.classList.add('btn-outline-purple');
            wizardBtn.style.background = '';
            wizardBtn.style.color = '';
            wizardBtn.style.borderColor = '';
        }
    }
}

// Global helper functions
window.formBuilderHelpers = {
    switchToWizard: switchToWizardMode,
    switchToForm: switchToFormMode,
    showHelp: showWizardHelp
};

window.showWizardHelp = showWizardHelp;

// Handle form submission
document.addEventListener('DOMContentLoaded', function() {
    const formElement = document.getElementById('formBuilderForm');
    if (formElement) {
        formElement.addEventListener('submit', function(e) {
            if (!builderInstance) {
                e.preventDefault();
                alert('Builder not ready');
                return;
            }
            const finalSchema = builderInstance.schema;
            finalSchema.display = currentDisplayMode;
            document.getElementById('formSchemaInput').value = JSON.stringify(finalSchema);
        });
    }
    
    // Initialize mode buttons
    updateModeButtons();
});
</script>
@endpush
