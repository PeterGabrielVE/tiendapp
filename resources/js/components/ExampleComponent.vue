<template>
    <div class="container container-activity p-4">
        <div class="row">
            <div class="col-md-6">
                <h2>Lista de Marcas</h2>
                <table class="table text-center">
                        <thead>
                            <tr>
                                <th scope="col">Nombre</th>
                                <th scope="col">Referencia</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="brand in arrayBrands" :key="brand.id">
                                <td v-text="brand.name"></td>
                                <td v-text="brand.reference"></td>
                                <td>
                                    <button class="btn btn-primary btn-sm" @click="loadFieldsUpdate(brand)" title="Editar"><i class="fa fa-edit"></i></button>

                                    <button class="btn btn-danger btn-sm" @click="deleteBrand(brand)" title="Borrar"><i class="fa fa-trash"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
            </div>
            <div class="col-md-6 mt-3">
                   <div v-if="errors.length" class="alert alert-danger">
                    <p v-if="errors.length">
                    <b>Por favor, corrija el(los) siguiente(s) error(es):</b>
                    <ul>
                    <li v-for="error in errors" :key="error.id">{{ error }}</li>
                    </ul>
                </p>
                </div>
                <div class="form-group">
                    <label>Nombre</label>
                    <input v-model="name" type="text" class="form-control">
                </div>
                <div class="form-group">
                    <label>Referencia</label>
                    <input v-model="reference" type="text" class="form-control">
                </div>
                <div class="container-buttons">
                    <button v-if="update == 0" @click="saveBrands()" class="btn btn-success">Añadir</button>
                    <button v-if="update != 0" @click="updateBrands()" class="btn btn-warning">Actualizar</button>
                    <button v-if="update != 0" @click="clearFields()" class="btn">Atrás</button>
                </div>
            </div>

        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                name:"",
                reference:"",
                update:0,
                arrayBrands:[],
                errors: [],
            }
        },
        methods:{
            checkform(){
                this.errors = [];
                 if (this.name === "") {
                     this.errors.push('El Nombre es obligatorio.');
                }
                if (this.reference === "") {
                     this.errors.push('La referencia es obligatoria.');
                }
            },
            getBrands(){
                let me =this;
                let url = '/brands'
                axios.get(url).then(function (response) {
                    me.arrayBrands = response.data;
                    console.log(response.data)
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            saveBrands(){
                let me =this;
                me.checkform();
                let url = '/brands/store'
                axios.post(url,{
                    'name':this.name,
                    'reference':this.reference,
                }).then(function (response) {
                    me.getBrands();
                    me.clearFields();
                })
                .catch(function (error) {
                    console.log(error);
                });

            },
            updateBrands(){
                let me = this;
                axios.put('/brands/update',{
                    'id':this.update,
                    'name':this.name,
                    'reference':this.reference,
                }).then(function (response) {
                   me.getBrands()
                   me.clearFields();
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            loadFieldsUpdate(data){
                this.update = data.id
                let me =this;
                let url = '/brands/search?id='+this.update;
                axios.get(url).then(function (response) {
                    me.name= response.data.name;
                    me.reference= response.data.reference;

                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });
            },
            deleteBrand(data){
                let me =this;
                let brand_id = data.id
                if (confirm('¿Seguro que deseas borrar esta marca?')) {
                    axios.delete('/brands/delete/'+brand_id
                    ).then(function (response) {
                        me.getBrands();
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
                }
            },
            clearFields(){
                this.name = "";
                this.reference = "";
                this.update = 0;
            }
        },
        mounted() {
           this.getBrands();
        }
    }
</script>
