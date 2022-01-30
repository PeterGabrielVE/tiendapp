<template>
    <div class="container p-4">
        <div class="row">
            <div class="col-md-6">
                <h2>Lista de Productos</h2>
                <table class="table text-center">
                        <thead>
                            <tr>
                                <th scope="col">Producto</th>
                                <th scope="col">Marca</th>
                                <th scope="col">Tamaño</th>
                                <th scope="col">Observaciones</th>
                                <th scope="col">Cantidad de Inventario</th>
                                <th scope="col">Fecha de Embarque</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="product in arrayProducts" :key="product.id">
                                <td v-text="product.name"></td>
                                <td v-text="product.brand"></td>
                                <td v-text="product.size"></td>
                                <td v-text="product.observations"></td>
                                <td v-text="product.quantity_inventory"></td>
                                <td v-text="product.boarding_date"></td>
                                <td>
                                    <button class="btn btn-primary btn-sm" @click="loadFieldsUpdate(product)" title="Editar"><i class="fa fa-edit"></i></button>
                                    <button class="btn btn-danger btn-sm" @click="deleteProduct(product)" title="Borrar"><i class="fa fa-trash"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
            </div>
            <div class="col-md-6">
                   <div v-if="errors.length" class="alert alert-danger">
                    <p v-if="errors.length">
                    <b>Por favor, corrija el(los) siguiente(s) error(es):</b>
                    <ul>
                    <li v-for="error in errors" :key="error.id">{{ error }}</li>
                    </ul>
                </p>
                </div>
                <div class="form-group">

                     <label>Seleccione Marca:</label>
                    <select class='form-control' v-model='id_brand'>
                            <option value='0' >Seleccione Marca</option>
                            <option v-for='data in brands' :value='data.id' :key='data.id'>{{ data.name }}</option>
                    </select>


                    <label>Nombre</label>
                    <input v-model="name" type="text" class="form-control">

                    <label>Tamaño</label>
                    <input v-model="size" type="text" class="form-control">

                    <label>Fecha de Embarcación</label>
                    <input v-model="boarding_date" type="date" class="form-control">

                    <label># Inventario</label>
                    <input v-model="quantity_inventory" type="number" class="form-control"  min="0">

                    <label>Observaciones</label>
                    <input v-model="observations" type="text" class="form-control">
                </div>
                <div class="container-buttons">

                    <button v-if="update == 0" @click="saveProducts()" class="btn btn-success">Añadir</button>
                    <button v-if="update != 0" @click="updateProducts()" class="btn btn-warning">Actualizar</button>
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
                id:"",
                id_brand:"",
                name:"",
                brand:"",
                size:"",
                boarding_date:"",
                observations:"",
                quantity_inventory:"",
                update:0,
                arrayProducts:[],
                errors: [],
                brands: [],
            }
        },
        methods:{
            checkform(){
                this.errors = [];
                 if (this.id_brand === "") {
                     this.errors.push('La marca es obligatorio.');
                }

                if (this.quantity_inventory === "") {
                     this.errors.push('La cantidad de inventario es obligatorio.');
                }

                if (this.name === "") {
                     this.errors.push('El nombre es obligatorio.');
                }

                if (this.boarding_date === "") {
                     this.errors.push('La fecha de embarcación es obligatorio.');
                }

                 if (this.observations === "") {
                     this.errors.push('La observación es obligatorio.');
                }

                 if (this.size === "") {
                     this.errors.push('La talla es obligatorio.');
                }

            },
            getProducts(){
                let me =this;
                let url = '/products'
                axios.get(url).then(function (response) {
                    me.arrayProducts = response.data;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            saveProducts(){
                let me =this;
                me.checkform();
                let url = '/products/guardar'
                axios.post(url,{
                    'id_brand':this.id_brand,
                    'name':this.name,
                    'size':this.size,
                    'quantity_inventory':this.quantity_inventory,
                    'boarding_date':this.boarding_date,
                    'observations':this.observations,
                }).then(function (response) {
                    me.getProducts();
                    me.clearFields();
                })
                .catch(function (error) {
                    console.log(error);
                });

            },
            updateProducts(){
                let me = this;
                me.checkform();
                axios.put('/products/actualizar',{
                    'id':this.update,
                    'id_brand':this.id_brand,
                    'name':this.name,
                    'size':this.size,
                    'quantity_inventory':this.quantity_inventory,
                    'boarding_date':this.boarding_date,
                    'observations':this.observations,
                }).then(function (response) {
                   me.getProducts()
                   me.clearFields();
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            loadFieldsUpdate(data){

                this.update = data.id
                let me =this;
               let url = '/products/search/'+this.update;
                axios.get(url).then(function (response) {
                    me.id= response.data.id;
                    me.id_brand= response.data.id_brand;
                    me.quantity_inventory= response.data.quantity_inventory
                    me.size= response.data.size;
                    me.name= response.data.name;
                    me.observations= response.data.observations;
                    me.boarding_date= response.data.boarding_date;

                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });
            },
            deleteProduct(data){//Esta nos abrirá un alert de javascript y si aceptamos borrará la tarea que hemos elegido
                let me =this;
                let product_id = data.id
                if (confirm('¿Seguro que deseas borrar esta producto?')) {
                    axios.delete('/products/borrar/'+product_id
                    ).then(function (response) {
                        me.getProducts();
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
                }
            },
             getBrands: function(){
                axios.get('/brands')
                    .then(function (response) {
                        this.brands = response.data;
                    }.bind(this));
            },
            clearFields(){
                this.id_brand = 0;
                this.name = "";
                this.size = "";
                this.observations = "";
                this.boarding_date = "";
                this.quantity_inventory = "";
                this.update = 0;
            }
        },
        mounted() {
           this.getBrands();
           this.getProducts();
        }
    }
</script>
