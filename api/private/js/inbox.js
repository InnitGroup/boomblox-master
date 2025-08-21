var selectAll;

if (document.getElementsByClassName) {
    selectAll = function(header) {
        const messages = document.querySelectorAll("#ctl00\\$robloxCph\\$SelectableMessage");

        messages.forEach(message => {
            if (message !== header) {
                message.checked = header.checked;
            }
        });
    } 
} else {
    selectAll = function(header) {
        var inputs = document.getElementsByTagName('input');
        for (var i = 0; i < inputs.length; i++) {
            if (
                inputs[i].type === 'checkbox' &&
                inputs[i] !== header &&
                inputs[i].className === 'messageCheckbox'
            ) {
                inputs[i].checked = header.checked;
            }
        }
    };
}
