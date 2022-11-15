function toggleMobileNavigation() {
      const mobileNavigation = document.getElementById("mobile-sidenav");
      mobileNavigation.classList.toggle('mobile-links-active');
    }
	
	const signUpButton = document.getElementById('signUp');
	const signInButton = document.getElementById('signIn');
	const containerr = document.getElementById('containerr');

	signUpButton.addEventListener('click', () => {
		containerr.classList.add("right-panel-active");
	});
	signInButton.addEventListener('click', () => {
		containerr.classList.remove("right-panel-active");
	});