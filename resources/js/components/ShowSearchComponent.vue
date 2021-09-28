<template>
        <form class="container-fluid my-4">
    <div class="row py-4">
        <div class="col text-center">
            <div class="display-6 text-light">
                Search for a Password
            </div>
        </div>
    </div>
    <div class="row py-4">
        <div class="col-md-3 col-sm-6 offset-sm-3 offset-md-4 col-10 offset-1 py-2 py-md-0">
            <input type="search" class="form-control" id="search" name='search' placeholder="Give me a keyword to search :)" ref="searchBar" @input="modifyFilter">
        </div>
        <div class="col-md-2 py-2 py-md-0 text-md-start text-center">
         <div class="dropdown">
             <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
               Search Filters
             </button>
             <ul class="dropdown-menu cloudy-dropdown" aria-labelledby="dropdownMenuButton1">
                <li><a class="dropdown-item dropdown-item-selected" @click="toggleSelect('none')" ref="noneOption">No Filters</a></li>
                <li><a class="dropdown-item" @click="toggleSelect('name')" ref="nameOption">Application</a></li>
                <li><a class="dropdown-item" @click="toggleSelect('handle')" ref="handleOption">Handle</a></li>
                <li><a class="dropdown-item" @click="toggleSelect('password')" ref="passwordOption">Password</a></li>
                <li><a class="dropdown-item" @click="toggleSelect('note')" ref="noteOption">Note</a></li>
             </ul>
           </div>
        </div>
    </div>
</form>


<div class="container bg-cloudy rounded">
    <div class="row">
        <div class="col responsive-cell px-3 py-3">
            <strong class="h2">Application</strong>
        </div>
        <div class="col responsive-cell px-3 py-3">
            <strong class="h2">Handle</strong>
        </div>
        <div class="col responsive-cell px-3 py-3">
            <strong class="h2">Password</strong>
        </div>
        <div class="col responsive-cell px-3 py-3">
            <strong class="h2">Options</strong>
        </div>
    </div>
    
    <div class="row border-top border-shallow" v-for="password in passwords" :key="password.id">
        <div class="col responsive-cell px-3 py-3">
            {{ password['name'] }}
        </div>
        <div class="col responsive-cell px-3 py-3">
            {{ password['handle'] }}
        </div>
        <div class="col responsive-cell px-3 py-3">
            {{ password['password'] }}
        </div>
        <div class="col responsive-cell px-3 py-3">
            <button class="btn btn-shallow me-2 d-flex align-items-center">
                <img class="svg-icon inverted" src="/svg/show.svg">
                <span class="m-1 mt-2">Show</span>
            </button>
        </div>
    </div>        

</div>
</template>

<script>
    export default {
        created() {
            this.showPasswords('','')
        },
        data() {
            return {
                passwords: [],
                selector:{
                    'none':true,
                    'name':false,
                    'handle':false,
                    'password':false,
                    'note':false,
                    options: [],
                    vars(){
                        return ['none','name','handle','password','note'];
                    },
                    selected(){
                        if(this['none']){
                            return ''
                        }else{
                            var tmp = [];
                            this.vars().forEach(element => {
                                if (this[element] == true){
                                    tmp.push(element);
                                }
                            });
                            
                            return tmp;
                        }
                    },
                    selectNone(){
                        this['none'] = true;
                        this['name'] = false;
                        this['handle'] = false;
                        this['password'] = false;
                        this['note'] = false;
                    },
                    select(prop){
                        this['none'] = false;
                        this[prop] = true;
                    }
                },
            }
        },
        methods: {
            showPasswords(keyword,filter){
                axios.post('/passwords',null,{ params: {keyword,filter}}).then(response=>{
                    this.passwords = response.data
                })
            },
            modifyFilter(){
                
                var keyword = this.$refs.searchBar.value
                this.showPasswords(keyword,this.selector.selected())
            },
            toggleSelect(item){
                if(item == 'none'){
                    var selected = this.selector.selected();
                    selected.forEach(e=>{
                        var ref = e+'Option';
                        this.$refs[ref].classList.remove('dropdown-item-selected');
                    })
                    this.$refs.noneOption.classList.add('dropdown-item-selected');
                    this.selector.selectNone();
                }else{
                    this.$refs.noneOption.classList.remove('dropdown-item-selected');
                    var ref = item+'Option';
                    this.$refs[ref].classList.add('dropdown-item-selected');
                    this.selector.select(item);
                }
                this.modifyFilter()
            }
        },
    }
</script>
