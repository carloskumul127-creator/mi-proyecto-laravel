import './bootstrap';

document.querySelectorAll('[data-password-toggle]').forEach((toggle) => {
	const input = document.getElementById(toggle.dataset.passwordToggle);

	if (!input) {
		return;
	}

	toggle.addEventListener('click', () => {
		const showPassword = input.type === 'password';

		input.type = showPassword ? 'text' : 'password';
		toggle.setAttribute('aria-label', showPassword ? 'Ocultar contraseña' : 'Mostrar contraseña');
		toggle.querySelector('[data-eye-open]')?.classList.toggle('hidden', showPassword);
		toggle.querySelector('[data-eye-closed]')?.classList.toggle('hidden', !showPassword);
	});
});

document.querySelectorAll('[data-avatar-input]').forEach((input) => {
	input.addEventListener('change', () => {
		const image = document.querySelector('[data-avatar-preview]');
		const file = input.files?.[0];

		if (image && file) {
			image.src = URL.createObjectURL(file);
		}
	});
});
