import { zxcvbn, zxcvbnOptions } from '@zxcvbn-ts/core'
import * as zxcvbnCommonPackage from '@zxcvbn-ts/language-common'
import * as zxcvbnEnPackage from '@zxcvbn-ts/language-en'
import * as zxcvbnDePackage from '@zxcvbn-ts/language-de'

// const password = 'somePassword'
const options = {
    translations: {
     ...zxcvbnEnPackage.translations,
     ...zxcvbnDePackage.translations,
    },
  graphs: zxcvbnCommonPackage.adjacencyGraphs,
  dictionary: {
    ...zxcvbnCommonPackage.dictionary,
    ...zxcvbnEnPackage.dictionary,
    ...zxcvbnDePackage.dictionary,
  },
}

zxcvbnOptions.setOptions(options)


document.addEventListener('DOMContentLoaded', function() {
    // Get reference to the password input field and strength indicator container
    const passwordInput = document.getElementById('password') as HTMLInputElement;
    const passwordStrength = document.getElementById('password-strength') as HTMLDivElement;

    // Add event listener to the password input field for real-time feedback
    passwordInput.addEventListener('input', () => {
        // Get the value of the password input field
        const password = passwordInput.value;

        // Calculate password strength using Zxcvbn
        const result = zxcvbn(password);

        // Update UI with password strength feedback
        passwordStrength.textContent = `Password strength: ${result.score}/4`;
    });
});


