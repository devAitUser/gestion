new Vue({
    el: '#app',
    vuetify: new Vuetify(),

    data() {

        return {
            dialog2: false,
            dialog: false,
            expanded: [],
            singleExpand: true,
            pagination: {
                rowsPerPage: 5,

            },
            projets : [],
            btn_control: false,
            singleSelect: false,
            selectedRows: [],
            selected: [],
            search: '',
            sortBy: 'status',
            sortDesc: true,
           

            headers: [

       

                {
                    text: 'Projet',
                    value: 'client'
                },

               
                {
                    text: 'Type',
                    value: 'status',
                    sortable: true
                },

                {
                    text: 'Solde Actuel',
                    value: 'solde'
                },
              
                
                
                {
                    text: "Action",
                    value: "action",
                    sortable: false
                }



            ],

            


              addItem: {
                id: 0,
                projet : '',
                debut : '',
                fin  : '',
                statut : '',
              },

              pointage: [

            ],
            affectation: [

            ],
            editedIndex: -1,
            editedItem: {
                id: 0,
                projet : '',
                debut : '',
                fin  : '',
                statut : '',
            },
            defaultItem: {
                id: 0,
                nom: '',
                date_create: '',
            },
            current_employe : ' '

        }
    },

    computed: {
        computedDateFormatted () {
          return this.formatDate(this.addItem.date_debut)
        }
      },
  
      watch: {
        date (val) {
          this.dateFormatted = this.formatDate(this.addItem.date_debut)
        }
      },


    methods: {

        editItem(item) {

            window.location.href = "caisse/" + item.id + "/detail"
        },

        formatDate (date) {
            if (!date) return null
    
            const [year, month, day] = date.split('-')
            return `${month}/${day}/${year}`
          },

        clicked(value) {
            const index = this.expanded.indexOf(value)



            if (index === -1) {
                this.expanded.push(value)

            } else {
                this.expanded.splice(index, 1)
            }

        },

        shwo_affectation (item) {
         
             this.affectation =  item.affectation;
             this.current_employe = item.id;

          
            
            this.dialog = true
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

        update_item_affectation(item){
        
            this.editedItem.projet =this.editedItem.projet.client ;
            axios.post(window.laravel.url + '/update_affectation/', this.editedItem )
            .then(response => {
                console.log(response.data);

            })
            .catch(error => {
                console.log(error);
            })


            this.dialog2 = false;


        },

        edit_Item_paiement(item){

            this.editedItem = item
            
            this.dialog2=true
        },
       
        deleteItem_affectation(item_id) {

           

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

                   

                        axios.post(window.laravel.url + '/delete_affectation/' + item_id)
                            .then(response => {

                         
                                const index = this.affectation.indexOf(item_id);


                            this.affectation.splice(index, 1);
                            
                           
        

                                

                            })
                            .catch(error => {
                          
                                
                            })

                           

                              


          




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

                        axios.delete(window.laravel.url + '/deleterh/' + this.selected[i].id)
                            .then(response => {

                   
                                const index = this.employe.indexOf(this.selected[i]);


                            this.employe.splice(index, 1);
                            
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

        btn_retour(){

            

            window.location.href = window.laravel.url + '/pointage';

        },

        get_data: function() {
            axios.get(window.laravel.url + '/caisse_get_projet')
                .then(response => {

                    this.pointage = response.data.projets;
                   


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