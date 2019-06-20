function goBack() {
    window.history.back();}

function updateMiasto(wojewodztwo) {
    fetch('/oferty/getmiasta/'+wojewodztwo)
        .then(
            function (response) {
                return response.text().then(function(text){
                    document.getElementById('miastoselect').innerHTML=text;

                }

            );
            }
        )
        .catch(
            function (error) {
                console.log(error);
            }
        );
}