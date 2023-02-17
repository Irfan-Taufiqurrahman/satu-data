<script setup>

props : ['page','index']
defineProps({
    page: {
        type : String,
    },
    nama : {
        type : String,
        required: false,
    }
});

</script>

<template> 
        <div class="flex justify-between h-16 items-center pr-4 bg-white w-full">
            <div class="pl-10">
                <p>
                    Hello, {{ nama }} , selamat datang di halaman {{ page.pageTitle }}
                </p>
            </div>
                <nav class="h-10 flex space-x-20 ">
                <a href="/reports" class="font-medium px-3 py-2 text-slate-700 rounded-lg hover:bg-slate-100 hover:text-slate-900">Log Out</a>
                </nav>
        </div>
   
        
</template>
<script>


</script>
<style scoped>


</style>