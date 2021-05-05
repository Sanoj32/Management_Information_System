<template>
    <span>
        <button
        class="btn float-right"
        v-bind:class=" { 'btn-success' : success, 'btn-danger' : danger }"
        @click='grant'
        > {{this.buttontext}} </button>
    </span>
</template>

<script>
export default {
    mounted() {
        console.log('component munted');
        console.log(this.connection, this.subjectCode,this.teacherCode)
    },
    props:['connection','subjectCode','teacherCode']
    ,
    data: function() {
        return {
            danger: this.connection,
            success: !this.connection
        };
    },
    computed:{
        buttontext: function(){
            return this.danger ? 'Revoke' : 'Grant';
        }
    },
    methods:{
        grant: function(){
            // console.log('Teacher id is '+ this.teacher_code + "subject id is" + this.subject_code)
            axios.post("/admin/teachers/" + this.teacherCode + "/edit/" + this.subjectCode).then(response => {
                this.success = !this.success;
                this.danger = !this.success;
                if(this.success == true){
                    this.message = "grant"
                }else{
                    this.message = "revoke"
                }
            });
        }
    }

};
</script>