<template>
    <div>
        <button
        class="btn"
        v-bind:class=" { 'btn-success' : present, 'btn-danger' : absent }"
        @click='grant'
        > {{this.buttontext}} </button>
    </div>
</template>

<script>
export default {
    mounted() {
        console.log('component mounted')
    },
    props: ['teacher_code','subject_code'],
    data: function() {
        return {
            present: true,
            absent: false,
        };
    },
    computed:{
        buttontext: function(){
            return this.present ? 'Grant' : 'Revoke';
        }
    },
    methods:{
        grant: function(){
            // console.log('Teacher id is '+ this.teacher_code + "subject id is" + this.subject_code)
            axios.post("/admin/teachers/" + this.teacher_code + "/edit/" + this.subject_code).then(response => {
                this.present = !this.present;
                this.absent = !this.present;
                if(this.present == true){
                    this.message = "grant"
                }else{
                    this.message = "revoke"
                }
            });
        }
    }

};
</script>