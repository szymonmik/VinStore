
//------------------------------------------------------- MODAL START -----------------------------------------------------------------
var modalWrap = null;
const albumModal = (id, title, artist, description, duration, cover, price, stock) => {

    if(modalWrap !== null){
        modalWrap.remove();
    }

    modalWrap = document.createElement('div');
    modalWrap.innerHTML = `
        <div class="modal" id="itemDescription">
            <div class="modal-lg modal-dialog modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header align-items-center">
                                <h5 class="modal-title">${artist} - ${title} <small class="text-muted">(ID: ${id})</small></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row d-flex flex-column flex-lg-row flex-xl-row">
                                    <div class="col">
                                        <img class="card-img-top" src="${cover}" alt="cover" />
                                    </div>
                                    <div class="col pt-4 pt-lg-0 pt-xl-0">
                                        <h4>Opis</h4>
                                        <p>${description}</p>
                                        <h6>Sztuk w magazynie: ${stock}</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer justify-content-between">
                                <div>
                                    <h3>${price} zł</h3>
                                </div>
                                <div>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zamknij</button>
                                    <button type="button" class="btn btn-primary" onclick="dodajProdukt('${id}')">Dodaj do koszyka</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    `;


    document.body.append(modalWrap);
    var modal = new bootstrap.Modal(modalWrap.querySelector('.modal'));
    modal.show();
}

// -------------------------------------------------------- MODAL END --------------------------------------------------------------------------
