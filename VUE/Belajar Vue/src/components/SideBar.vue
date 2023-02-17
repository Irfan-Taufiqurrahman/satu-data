<script setup>

import Coba from './Header.vue'
import Isi from './Content.vue'
</script>

<template> 
        <div class="flex min-h-screen font-lexend drop-shadow-md">
            <div class="w-80 bg-white rounded-br-lg ">
                <div>
                    <h3 class="pt-5 pb-5 text-center text-2xl font-bold border-b border-stone-700">SATU DATA PEMDA SURABAYA</h3>
                </div>
                
                <div class="flex border-b border-black font-bold">
                    <p class="text-xl p-4">Main</p>
                </div>
                <div class="grid grid-cols-1 gap-4 p-4 text-l" >
                    <div v-for="(page, index) in Pages"  :class="{'bg-slate-900 rounded-xl p-2 hover:bg-slate-700 text-white': isActive == index, 'p-2 hover:bg-sky-200 rounded-xl': isActive != index}" >
                        <a href="" @click.prevent="isActive = index">{{ page.pageTitle }}</a>
                    </div>

                    <!-- <div class="p-2 hover:bg-sky-200 rounded-xl bg-slate-900 rounded-xl p-2 hover:bg-slate-700 text-white">
                        
                        <a href="">Dataset</a>
                    </div>
                    <div class="p-2 hover:bg-sky-200 rounded-xl">
                        
                        <a href="">Main Data</a>
                    </div>
                     -->
                </div>
                <div class="flex border-b border-black font-bold">
                    <p class="text-xl p-4">Setting</p>
                </div>
                <div class="grid grid-cols-1 gap-4 p-4 text-l">
                    <div class="p-2 hover:bg-sky-200 rounded-xl">
                        <a href="">Account</a>
                    </div>
                    <div class="p-2 hover:bg-sky-200 rounded-xl">
                        
                        <a href="">Help</a>
                    </div>
                    <div class="p-2 hover:bg-sky-200 rounded-xl">
                            
                        <a href="">Sign Out</a>
                    </div>
                    
                </div>
                <div class="static" >
                    <div class="p-5 font-light absolute bottom-0 left-0" >
                        <small><p>Build with Love by Reza  </p></small>
                    </div>
                </div>
            </div>
            <div class="flex flex-col w-full">
                <Coba :page="Pages[isActive]"/>
                <Isi/>
            </div>
        </div>
</template>

<script>
export default{
  data() {
    return {
        isActive : 0,
      Pages : [
        {
            pageTitle : 'Dashboard',
            url : 'dhb.html',
        },
        {
            pageTitle : 'Dataset',
            url : 'dhb.html',
        },
        {
            pageTitle : 'Main Data',
            url : 'dhb.html',
        },
      ]
    }
  }
}

</script>