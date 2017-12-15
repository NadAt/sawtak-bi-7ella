window.onload=function() {
	function sendMail() {
	var firstName = $('#firstName').val();
	var lastName = $('#lastName').val();
	var email = $('#email').val();
	var phone = $('#phone').val();
	var subject = $('#subject').val();
	var message = $('#bodyMessage').val();
	
	window.location.href = 'mailto:volunteer-house@outlook.com?subject=' + subject + '&body=Thank you, ' + lastName + ' ' + firstName + ', for contacting us.' + 'Your Phone number is: ' + phone + '. Dear volunteerHouse developers, ' +  message + '&cc=okb01@mail.aub.edu, nnf03@mail.aub.edu&bcc=' + email;
	}
}