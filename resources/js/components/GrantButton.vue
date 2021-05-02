<template>
    <div>

      {{ message }}

    </div>
</template>

<script>
export default {
    mounted() {
        console.log('component mounted')
    },
    data: function() {
        return {
            message: "Hello world"
        };
    },

};
</script>