new Vue({
    el: '#app_client',
    vuetify: new Vuetify(),

    data() {

        return {
            dialog: false,
            expanded: [],
            singleExpand: true,
            pagination: {
                rowsPerPage: 5,

            },
            btn_control: false,
            singleSelect: false,
            selectedRows: [],
            selected: [],
            search: '',
            sortBy: 'id',
            sortDesc: true,

            headers: [

       
                {
                    text: 'client',
                    value: 'client'
                },
                {
                    text: 'Type prestation',
                    value: 'type_prestation'
                },
                {
                    text: 'Objet',
                    value: 'objet'
                },
                {
                    text: 'n marche',
                    value: 'n_marche'
                },
                {
                    text: 'date debut',
                 
                    value: 'date_debut'
                },
                {
                    text: 'Duree',
                    value: 'duree'
                }
                
                
                ,
                {
                    text: 'Montant max ',
                    value: 'montant_max'
                }
                ,

                {
                    text: 'Fichier CPS',
                    value: 'file'
                }
                ,

                
                {
                    text: 'PDF',
                    value: 'pdf'
                }
                ,
               
                {
                    text: "Action",
                    value: "action",
                    sortable: false
                }



            ],

            clients: [

            ],
            editedIndex: -1,
            editedItem: {
                id: 0,
                nom: '',
                date_create: '',
            },
            defaultItem: {
                id: 0,
                nom: '',
                date_create: '',
            },

        }
    },


    methods: {

        editItem(item) {

            window.location.href = "projets/" + item.id + "/edit"
        },

        PDF_file(item) {

            window.location.href = "generate_pdf/" + item.id 
        },

        clicked(value) {
            const index = this.expanded.indexOf(value)



            if (index === -1) {
                this.expanded.push(value)

            } else {
                this.expanded.splice(index, 1)
            }

        },


   



        save() {

            if (this.editedIndex > -1) {
                Object.assign(this.gategorie[this.editedIndex], this.editedItem)
                this.update_gategorie(this.editedItem)

            } else {
                this.gategorie.push(this.editedItem)
            }

            this.close()

        },
        show_file(item){
    
            var link = item.file;
                link = link.replace("public", "");
                window.location.href = window.laravel.url + "/storage" + link 

        },

        close() {

            this.dialog = false
            this.$nextTick(() => {
                this.editedItem = Object.assign({}, this.defaultItem)
                this.editedIndex = -1

            })
            this.expanded = [];

        },

        item: function(values) {

            if (values.length > 0) {

                this.btn_control = true;

            } else {
                this.btn_control = false;

            }


        },

        deleteItem() {

            Swal.fire({
                title: 'Êtes-vous sûr?',
                text: "voulez vous vraiment  supprimé",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Retour',
                confirmButtonText: 'Oui, Supprimé !'
            }).then((result) => {
                if (result.value) {

                    for (var i = 0; i < this.selected.length; i++) {

                        axios.delete(window.laravel.url + '/deleteprojets/' + this.selected[i].id)
                            .then(response => {

                   
                                const index = this.clients.indexOf(this.selected[i]);


                            this.clients.splice(index, 1);
                            
                            this.selected = [];
        

                                

                            })
                            .catch(error => {
                          
                                
                            })

                           

                              


                        
                    }
                  




                    this.btn_control = false;

                    Swal.fire({

                            title: 'Supprimer!',
                            html: ' supprimer aver succes.',
                            icon: 'success',
                            timer: 1000,
                            showConfirmButton: false,


                            onBeforeOpen: () => {

                                timerInterval = setInterval(() => {
                                    const content = Swal.getContent()
                                    if (content) {
                                        const b = content.querySelector('b')
                                        if (b) {
                                            b.textContent = Swal.getTimerLeft()
                                        }
                                    }
                                }, 100)
                            },
                            onClose: () => {
                                clearInterval(timerInterval)
                            }


                        }

                    )
                }
            })



        },
        remove_item() {

            if(this.btn_control){
                this.deleteItem();
            }
            else{

                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Au moins un élément doit être sélectionné!',
                  })

            }

        },

        get_data: function() {
            axios.get(window.laravel.url + '/getprojets')
                .then(response => {

                    this.clients = response.data.projets;
                 


                })
                .catch(error => {
                    console.log(error);
                })
        }
    },
    mounted: function() {

        this.get_data();



    }



})