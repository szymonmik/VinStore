const albumsReq = new Request('http://localhost:3000/albums');
const usersReq = new Request('http://localhost:3000/users')


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

// -------------------------------------------------------- CARDS START ------------------------------------------------------------------------

fetch(albumsReq)
    .then(response => response.json())
    .then(data => {
        var state = {
            'querySet': data,
            'page': 1,
            'perPage': 6,
        }

        function pagination(querySet, page, perPage){
            var trimStart = (page - 1) * perPage;
            var trimEnd = trimStart + perPage;

            var trimmedData = querySet.slice(trimStart, trimEnd);

            var pages = Math.ceil(querySet.length / perPage);

            return{
                'querySet': trimmedData,
                'pages': pages
            }
        }

        function buildGrid(){
            let data = pagination(state.querySet, state.page, state.perPage)
            console.log(data);

            let content = "";
            for (const product of data.querySet) {
                content += `
                    <div class="col-lg-4 col-sm-12 col-md-6 col-lg-4 mb-5" onClick="albumModal(${product.id},'${product.title}','${product.artist}', '${product.description}','${product.cover}','${product.price}');">
                        <div class="card h-100 shadow border-0">
                            <img class="card-img-top" src="${product.cover}" alt="id:${product.id}" />
                            <div class="card-body p-4 pb-0">
                                <div class="badge bg-primary bg-gradient rounded-pill mb-2">${product.genre}</div>
                                <a class="text-decoration-none link-dark stretched-link" href="#!" ><h5 class="card-title mb-3">${product.artist} - ${product.title}</h5></a>
                            </div>
                            <div class="card-footer p-4 pt-0 bg-transparent border-top-0">
                                <div class="d-flex align-items-end justify-content-between">
                                    <div class="d-flex align-items-center">
                                        <div class="small>
                                            <div class="text-muted">${product.year} &middot; ${product.duration}</div>
                                        </div>
                                        <div class="fw-bold">${product.price} zł</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>`;

            }
            document.getElementById('album-catalog').innerHTML = content;

            pageButtons(data.pages);
        }

        buildGrid();

        function pageButtons(pages){
            let wrapper = document.getElementById('pagination-wrapper');
            wrapper.innerHTML = '';

            for(let page = 1; page <= pages; page++){
                wrapper.innerHTML += `<button value=${page} class="page btn btn-dark btn-info mx-1">${page}</button>`;
            }

            $('.page').on('click', function(){
                $('#table-body').empty()
                state.page = $(this).val()
                buildGrid();
            })
        }

})
    .catch(console.error);

// -------------------------------------------------------- CARDS END ------------------------------------------------------------------------

