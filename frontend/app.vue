<template>
    <div class=" w-[100wh] h-full flex flex-col gap-y-16  bg-[#fffffe] p-12">
        <div class="flex gap-14 h-[380px] ">
            <form @submit.prevent="cadastraVacina"
                class="p-4 flex flex-col gap-y-3 justify-center items-center rounded-lg [&>div]:flex [&>div]:w-full [&>div]:flex-col [&>div]:gap-y-1 w-[30%] bg-[#e3f6f5] text-[#272343] font-semibold shadow-md shadow-[#272343]/20">
                <h1 class="text-xl">Vacinas</h1>
                <div>
                    <label for="">ID Vacina </label>
                    <input type="text" v-model="idVacina" class="w-[85%] h-7 pl-3 bg-[#fffffe] rounded-md"></input>
                </div>

                <div>
                    <label for="">Nome da vacina</label>
                    <input type="text" v-model="nomeVacina" class="w-[85%] h-7 pl-3 bg-[#fffffe] rounded-md"></input>
                </div>

                <div>
                    <label for="">Fabricante</label>
                    <input type="text" v-model="fabricante" class="w-[85%] h-7 pl-3 bg-[#fffffe] rounded-md"></input>
                </div>

                <div>
                    <label for="">Quantidade de Doses</label>
                    <input type="text" v-model="qtdDoses" class="w-[85%] h-7 pl-3 bg-[#fffffe] rounded-md"></input>
                </div>


                <button type="submit" class="w-[40%] h-7 rounded-md bg-[#ffd803]">Enviar</button>
            </form>

            <Table class="bg-[#e3f6f5] rounded-md shadow-lg">
                <TableHeader>
                    <TableRow>
                        <TableHead class="w-[100px]">
                            ID Vacina
                        </TableHead>
                        <TableHead>Nome Vacina</TableHead>
                        <TableHead>Fabricante</TableHead>
                        <TableHead class="text-right">
                            Quantidade de doses
                        </TableHead>
                    </TableRow>
                </TableHeader>
                <TableBody>
                    <TableRow v-for="vacina in vacinas.data._rawValue.data" :key="vacina.idVacina">
                        <TableCell class="font-medium">
                            {{ vacina.idVacina }}
                        </TableCell>
                        <TableCell>{{ vacina.nomeVacina }}</TableCell>
                        <TableCell>{{ vacina.fabricante }}</TableCell>
                        <TableCell class="text-right">
                            {{ vacina.qtdDoses }}
                        </TableCell>
                    </TableRow>
                </TableBody>
            </Table>
        </div>


       





    </div>
</template>


<script setup>
import {
    Table,
    TableBody,
    TableCell,
    TableHead,
    TableHeader,
    TableRow,
} from '@/components/ui/table'
import { ref } from "vue";
import { useFetch } from "nuxt/app";
const vacinas = await useFetch('http://127.0.0.1:8000/api/vacinas');

const idVacina = ref('');
const nomeVacina = ref('');
const fabricante = ref('');
const qtdDoses = ref('');

async function cadastraVacina() {
    await useFetch('http://127.0.0.1:8000/api/vacinas/registrar-vacina', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: {
            idVacina: idVacina.value,
            nomeVacina: nomeVacina.value,
            fabricante: fabricante.value,
            qtdDoses: qtdDoses.value
        }
    })

    idVacina.value = '';
    nomeVacina.value = '';
    fabricante.value = '';
    qtdDoses.value = '';



}
</script>
