document.addEventListener('DOMContentLoaded', () => {
    let currentStep = 1; // Tracks the overall step (1, 2, 3, 4)
    const form = document.getElementById('multi-step-form');
    const stepContents = document.querySelectorAll('.step-content');
    const nextButtons = document.querySelectorAll('.next-step-btn');
    const prevButtons = document.querySelectorAll('.prev-step-btn');
    const stepItems = document.querySelectorAll('.step-item');
    const stepSeparators = document.querySelectorAll('.step-separator');
    const messageBox = document.getElementById('message-box');
    const stepStatusText = document.getElementById('step-status-text');
    const mainHeaderText = document.getElementById('main-header-text');
    const progressBarContainer = document.getElementById('progress-bar-container');
    const startStep2Btn = document.getElementById('start-step-2-btn');
    const mainContainer = document.getElementById('main-container');
    const imageColumn = document.getElementById('image-column');

    // --- UI Update Logic ---
    function updateSteps() {
        // Layout switch
        if (currentStep === 1) {
            mainContainer.classList.remove('max-w-2xl', 'grid-cols-1');
            mainContainer.classList.add('max-w-6xl', 'lg:grid-cols-2');
            imageColumn.classList.remove('hidden');
        } else {
            mainContainer.classList.remove('max-w-6xl', 'lg:grid-cols-2');
            mainContainer.classList.add('max-w-2xl', 'grid-cols-1');
            imageColumn.classList.add('hidden');
        }

        // Show current step content
        stepContents.forEach(content => {
            const step = parseInt(content.dataset.step);
            content.classList.toggle('hidden', step !== currentStep);
        });

        // Progress bar & header
        const progressSteps = ['About Your Farm', 'Preferences', 'Complete'];
        progressBarContainer.classList.toggle('hidden', currentStep === 1);

        if (currentStep === 1) {
            mainHeaderText.textContent = 'Create Your Account';
            stepStatusText.textContent = 'Start your free trial today';
        } else {
            const wizardStepIndex = currentStep - 2; // 2->0, 3->1, 4->2
            mainHeaderText.textContent = progressSteps[wizardStepIndex];
            stepStatusText.textContent = `Step ${wizardStepIndex + 1} of 3`;

            // Update circles
            stepItems.forEach(item => {
                const step = parseInt(item.dataset.step);
                item.classList.remove('active', 'completed');
                if (step === currentStep) item.classList.add('active');
                else if (step < currentStep) item.classList.add('completed');
            });

            // Update separators
            stepSeparators.forEach(separator => {
                const step = parseInt(separator.dataset.separatorStep);
                separator.classList.toggle('completed', step < currentStep);
            });
        }

        window.scrollTo(0, 0);
    }

    // --- Message Utility ---
    function showMessage(msg, type) {
        messageBox.className = 'p-3 mb-6 rounded-lg font-medium text-sm text-center';
        messageBox.textContent = msg;
        if (type === 'error') messageBox.classList.add('bg-red-100','text-red-800');
        else if (type === 'success') messageBox.classList.add('bg-green-100','text-green-800');
        else messageBox.classList.add('hidden');
    }

    // --- Validation Logic ---
    function validateStep(step) {
        const stepEl = document.getElementById(`step-${step}`);
        const requiredFields = stepEl.querySelectorAll('input[required], select[required], textarea[required]');
        let valid = true;

        requiredFields.forEach(f => {
            f.classList.remove('border-red-500');
            if(f.value.trim() === '') {
                f.classList.add('border-red-500');
                valid = false;
            }
        });

        if(step === 1) {
            const email = document.getElementById('email').value.trim();
            const password = document.getElementById('password').value;
            const termsChecked = document.getElementById('agree-terms').checked;

            if(!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)){
                showMessage('Please enter a valid email.','error');
                document.getElementById('email').classList.add('border-red-500');
                return false;
            }
            if(password.length < 8){
                showMessage('Password must be at least 8 characters.','error');
                document.getElementById('password').classList.add('border-red-500');
                return false;
            }
            if(!termsChecked){
                showMessage('You must agree to Terms & Conditions.','error');
                return false;
            }
        }

        if(step === 3) {
            // Example for Step 3: just check at least one checkbox selected
            const checkboxes = stepEl.querySelectorAll('input[type="checkbox"]');
            if(checkboxes.length>0 && !Array.from(checkboxes).some(c => c.checked)){
                showMessage('Please select at least one option.','error');
                return false;
            }
        }

        if(!valid) {
            showMessage('Please fill all required fields.','error');
            return false;
        }

        showMessage('', '');
        return true;
    }

    // --- Event Listeners ---

    // Step 1 "Register"
    startStep2Btn.addEventListener('click', ()=>{
        if(validateStep(1)){
            currentStep = 2;
            updateSteps();
        }
    });

    // Next buttons
    nextButtons.forEach(btn=>{
        btn.addEventListener('click', ()=>{
            if(validateStep(currentStep)){
                currentStep = parseInt(btn.dataset.nextStep);
                updateSteps();
            }
        });
    });

    // Previous buttons
    prevButtons.forEach(btn=>{
        btn.addEventListener('click', ()=>{
            currentStep = parseInt(btn.dataset.prevStep);
            updateSteps();
            showMessage('', '');
        });
    });

    // Step 4 / Final submission
    form.addEventListener('submit', e=>{
        e.preventDefault();
        if(currentStep === 4){
            // Simulate final success
            showMessage('✅ Registration Successful! Please verify your email.','success');
            document.querySelector('#step-4 button').disabled = true;

            setTimeout(()=>{
                console.log('Redirect to dashboard or login...');
            },2000);
        }
    });

    // Initial render
    updateSteps();
});
