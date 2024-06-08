document.addEventListener('DOMContentLoaded', function () {
	const mainDiv = document.querySelector('.main');
	const loginLabel = document.getElementById('loginLabel');
	const signupLabel = document.getElementById('signupLabel');

	loginLabel.addEventListener('click', function () {
		mainDiv.classList.remove('active');
		//"Login";
	});

	signupLabel.addEventListener('click', function () {
		mainDiv.classList.add('active');
		//"Sign Up";
	});
    // addEventListener itu nambahin event ke element yang kita 
    // jadi label Login dan Sign Up bisa di klik
    // 'DOMContentLoaded' fungsinya akan jalan kalau DOM telah diload
});
