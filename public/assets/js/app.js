function submitContactForm() {

    var contactForm = $('form#contact');
    var submitButton = $('input#submit');

    submitButton.attr('disabled',true);

    $.post('/postContactForm', contactForm.serialize(), function(data){
        if(data.success == '1'){
            alert('You message has been sent successfully');
            contactForm[0].reset();
            submitButton.attr('disabled',false);
        }else{
            alert(data.errors[0]);
            submitButton.attr('disabled',false);
            return false;
        }
    },'json');

    return false;
}