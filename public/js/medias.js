window.onload = () => {
    // Gestion des liens 'Delete'
    let links = document.querySelectorAll("[data-delete]")
    
    // Boucle sur links
    for(link of links){
        // Écoute du clic
        link.addEventListener("click", function(e){
            // Empechement de navigation
            e.preventDefault()

            // Demande de confirmation
            if(confirm("Are you sure to want to delete this picture?")){
                // Envoi de la requête Ajax vers le href du lien avec la méthode DELETE
                fetch(this.getAttribute("href"), {
                    method: "DELETE",
                    headers: {
                        "X-Requested-With": "XMLHttpRequest",
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({"_token": this.dataset.token})
                }).then(
                    // Récupération de la réponse en JSON
                    response => response.json()
                ).then(data => {
                    if(data.success)
                        this.parentElement.parentElement.parentElement.remove()
                    else
                        alert(data.error)
                }).catch(e => alert(e))
            }
        })
    }
}