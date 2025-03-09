<template>
    <div class=" w-[100wh] h-full flex flex-col gap-y-16  bg-[#fffffe] p-12">
        <div class="flex gap-14 h-[380px] ">
            <form @submit.prevent="cadastraVacina"
                class="p-4 flex flex-col gap-y-3 justify-center items-center rounded-lg [&>div]:flex [&>div]:w-full [&>div]:flex-col [&>div]:gap-y-1 w-[30%] bg-[#e3f6f5] text-[#272343] font-semibold shadow-md shadow-[#272343]/20">
                <h1 class="text-xl">Vacinas</h1>
                <div>
                    <label for="">ID Vacina </label>
                    <input type="text" v-model="idVacinaVacina"
                        class="w-[85%] h-7 pl-3 bg-[#fffffe] rounded-md"></input>
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

        <div class="flex gap-14 h-[380px] ">
            <form @submit.prevent="cadastraLote"
                class="p-4 flex flex-col gap-y-3 justify-center items-center rounded-lg [&>div]:flex [&>div]:w-full [&>div]:flex-col [&>div]:gap-y-1 w-[30%] bg-[#e3f6f5] text-[#272343] font-semibold shadow-md shadow-[#272343]/20">
                <h1 class="text-xl">Lotes</h1>
                <div>
                    <label for="">ID Lote </label>
                    <input type="text" v-model="idLoteLote" class="w-[85%] h-7 pl-3 bg-[#fffffe] rounded-md"></input>
                </div>

                <div>
                    <label for="">ID Vacina</label>
                    <input type="text" v-model="idVacinaLote" class="w-[85%] h-7 pl-3 bg-[#fffffe] rounded-md"></input>
                </div>

                <div>
                    <label for="">Quantidade</label>
                    <input type="text" v-model="quantidade" class="w-[85%] h-7 pl-3 bg-[#fffffe] rounded-md"></input>
                </div>

                <div>
                    <label for="">Validade</label>
                    <input type="date" v-model="validade" class="w-[85%] h-7 pl-3 bg-[#fffffe] rounded-md"></input>
                </div>


                <button type="submit" class="w-[40%] h-7 rounded-md bg-[#ffd803]">Enviar</button>
            </form>

            <Table class="bg-[#e3f6f5] rounded-md shadow-lg">
                <TableHeader>
                    <TableRow>
                        <TableHead class="w-[100px]">
                            ID Lote
                        </TableHead>
                        <TableHead>ID Vacina</TableHead>
                        <TableHead>Quantidade</TableHead>
                        <TableHead class="text-right">
                            Validade
                        </TableHead>
                    </TableRow>
                </TableHeader>
                <TableBody>
                    <TableRow v-for="lote in lotes.data._rawValue.data" :key="lote.idVacina">
                        <TableCell class="font-medium">
                            {{ lote.idLote }}
                        </TableCell>
                        <TableCell>{{ lote.idVacina }}</TableCell>
                        <TableCell>{{ lote.qtdDisponivel }}</TableCell>
                        <TableCell class="text-right">
                            {{ lote.validade }}
                        </TableCell>
                    </TableRow>
                </TableBody>
            </Table>
        </div>


        <div class="flex gap-14 h-[900px] ">
            <form @submit.prevent="cadastraMorador"
                class="p-4 flex flex-col gap-y-3 justify-center items-center rounded-lg [&>div]:flex [&>div]:w-full [&>div]:flex-col [&>div]:gap-y-1 w-[30%] bg-[#e3f6f5] text-[#272343] font-semibold shadow-md shadow-[#272343]/20">
                <h1 class="text-xl">Morador</h1>
                <div>
                    <label for="">Nome </label>
                    <input type="text" v-model="nomeMorador" class="w-[85%] h-7 pl-3 bg-[#fffffe] rounded-md"></input>
                </div>

                <div>
                    <label for="">CPF</label>
                    <input type="text" v-model="cpfMoradorMorador"
                        class="w-[85%] h-7 pl-3 bg-[#fffffe] rounded-md"></input>
                </div>

                <div>
                    <label for="">Número do SUS</label>
                    <input type="text" v-model="numeroSus" class="w-[85%] h-7 pl-3 bg-[#fffffe] rounded-md"></input>
                </div>

                <div>
                    <label for="">Data de nascimento</label>
                    <input type="date" v-model="dataNascimento"
                        class="w-[85%] h-7 pl-3 bg-[#fffffe] rounded-md"></input>
                </div>

                <div>
                    <label for="">Nome da mãe</label>
                    <input type="text" v-model="nomeMae" class="w-[85%] h-7 pl-3 bg-[#fffffe] rounded-md"></input>
                </div>

                <div>
                    <label for="">Sexo</label>
                    <input type="text" v-model="sexo" class="w-[85%] h-7 pl-3 bg-[#fffffe] rounded-md"></input>
                </div>

                <div>
                    <label for="">Endereço</label>
                    <input type="text" v-model="endereco" class="w-[85%] h-7 pl-3 bg-[#fffffe] rounded-md"></input>
                </div>

                <div>
                    <label for="">Estado Civil</label>
                    <input type="text" v-model="estadoCivil" class="w-[85%] h-7 pl-3 bg-[#fffffe] rounded-md"></input>
                </div>

                <div>
                    <label for="">Escolaridade</label>
                    <input type="text" v-model="escolaridade" class="w-[85%] h-7 pl-3 bg-[#fffffe] rounded-md"></input>
                </div>

                <div>
                    <label for="">Etnia</label>
                    <input type="text" v-model="etnia" class="w-[85%] h-7 pl-3 bg-[#fffffe] rounded-md"></input>
                </div>

                <div>
                    <label for="">Plano de saúde</label>
                    <input type="text" v-model="planoSaude" class="w-[85%] h-7 pl-3 bg-[#fffffe] rounded-md"></input>
                </div>


                <button type="submit" class="w-[40%] h-7 rounded-md bg-[#ffd803]">Enviar</button>
            </form>

            <Table class="bg-[#e3f6f5] rounded-md shadow-lg">
                <TableHeader>
                    <TableRow>
                        <TableHead class="w-[100px]">
                            CPF
                        </TableHead>
                        <TableHead>Nome</TableHead>
                        <TableHead>Numero do SUS</TableHead>
                        <TableHead class="text-right">
                            Data de nascimento
                        </TableHead>
                    </TableRow>
                </TableHeader>
                <TableBody>
                    <TableRow v-for="morador in moradores.data._rawValue.data" :key="morador.idVacina">
                        <TableCell class="font-medium">
                            {{ morador.cpfMorador }}
                        </TableCell>
                        <TableCell>{{ morador.nomeMorador }}</TableCell>
                        <TableCell>{{ morador.nmrSUS }}</TableCell>
                        <TableCell class="text-right">
                            {{ morador.dataNascimento }}
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

const lotes = await useFetch('http://127.0.0.1:8000/api/lotes/emitir-relatorio-estoque');

const moradores = await useFetch('http://127.0.0.1:8000/api/moradores');


const idVacinaVacina = ref('');
const nomeVacina = ref('');
const fabricante = ref('');
const qtdDoses = ref('');


const idVacinaLote = ref('');
const idLoteLote = ref('');
const validade = ref('');
const quantidade = ref('');

const cpfMoradorMorador = ref('');
const nomeMorador = ref('');
const numeroSus = ref('');
const dataNascimento = ref('');
const nomeMae = ref('');
const sexo = ref('');
const endereco = ref('');
const estadoCivil = ref('');
const escolaridade = ref('');
const etnia = ref('');
const planoSaude = ref('');

async function cadastraVacina() {
    await useFetch('http://127.0.0.1:8000/api/vacinas/registrar-vacina', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: {
            idVacina: idVacinaLote.value,
            nomeVacina: nomeVacina.value,
            fabricante: fabricante.value,
            qtdDoses: qtdDoses.value
        }
    })

    idVacinaVacina.value = '';
    nomeVacina.value = '';
    fabricante.value = '';
    qtdDoses.value = '';



}

async function cadastraLote() {
    await useFetch('http://127.0.0.1:8000/api/lotes/registrar-entrada', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: {
            idVacina: idVacinaLote.value,
            idLote: idLoteLote.value,
            validade: validade.value,
            qtdDisponivel: quantidade.value,
            qtdRecebida: quantidade.value



        }
    })

    idVacinaLote.value = '';
    idLoteLote.value = '';
    validade.value = '';
    quantidade.value = '';



}

async function cadastraMorador() {
    const response = await useFetch('http://127.0.0.1:8000/api/moradores/cadastrar-morador', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: {
            cpfMorador: cpfMoradorMorador.value,
            nmrSUS: numeroSus.value,
            nomeMorador: nomeMorador.value,
            nomeMae: nomeMae.value,
            sexo: sexo.value,
            endereco: endereco.value,
            estadoCivil: estadoCivil.value,
            escolaridade: escolaridade.value,
            etnia: etnia.value,
            planoSaude: planoSaude.value,
            dataNascimento: dataNascimento.value



        }
    })

    console.log(response);
    // cpfMoradorMorador.value = '';
    // numeroSus.value = '';
    // nomeMorador.value = '';
    // nomeMae.value = '';
    // sexo.value = '';
    // endereco.value = '';
    // estadoCivil.value = '';
    // escolaridade.value = '';
    // etnia.value = '';
    // planoSaude.value = '';
    // dataNascimento.value = '';



}
</script>
