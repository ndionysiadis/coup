<script setup lang="ts">
import {Head, router} from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import HeadingLarge from "@/Components/Texts/HeadingLarge.vue";
import Breadcrumb from "@/Components/Pagination/Breadcrumb.vue";
import Breadcrumbs from "@/Components/Pagination/Breadcrumbs.vue";
import {formatTitleCase} from "@/Shared/globalFunctions";
import IconSecondaryButton from "@/Components/Buttons/IconSecondaryButton.vue";
import {PhArrowUUpLeft, PhPencilSimple, PhTrash, PhWarningCircle} from "@phosphor-icons/vue";
import CategoryCard from "@/Models/CategoryCard.vue";
import AppLink from "@/Components/Links/AppLink.vue";
import CardContainer from "@/Components/Cards/CardContainer.vue";
import {ref} from "vue";
import PrimaryModal from "@/Components/Modals/PrimaryModal.vue";
import DangerButton from "@/Components/DangerButton.vue";
import SecondaryButton from "@/Components/Buttons/SecondaryButton.vue";


const props = defineProps<{
    menuType: App.Data.MenuTypeData
}>()

const modalOpen = ref<boolean>(false)

const title = formatTitleCase(props.menuType.name)

function destroy() {
    router.delete(route('menu.destroy', props.menuType), {
        preserveState: true,
        preserveScroll: true,
        only: [
            'toast'
        ]
    })
}
</script>

<template>
    <Head :title="title"/>

    <AuthenticatedLayout>
        <template #breadcrumbs>
            <Breadcrumbs>
                <Breadcrumb first :href="route('menu.index')">
                    Menu's
                </Breadcrumb>

                <Breadcrumb :href="route('menu.show', menuType)">
                    {{ title }}
                </Breadcrumb>
            </Breadcrumbs>
        </template>

        <div class="flex items-center justify-between mb-4">
            <div class="flex flex-col">
                <HeadingLarge> {{ title }}</HeadingLarge>
            </div>

            <div class="flex items-center gap-2">
                <AppLink :href="route('menu.index')">
                    <IconSecondaryButton title="Επιστροφή">
                        <PhArrowUUpLeft weight="bold"/>
                    </IconSecondaryButton>
                </AppLink>

                <AppLink :href="route('menu.edit', menuType)">
                    <IconSecondaryButton title="Επεξεργασία">
                        <PhPencilSimple weight="fill"/>
                    </IconSecondaryButton>
                </AppLink>

                <IconSecondaryButton title="Διαγραφή" @click="modalOpen=!modalOpen">
                    <PhTrash weight="fill"/>
                </IconSecondaryButton>
            </div>

            <PrimaryModal
                :open="modalOpen"
                @closeModal="modalOpen=false"
            >
                <template #icon>
                    <PhWarningCircle weight="bold" size="24"/>
                </template>

                <template #title>
                    Διαγραφή μενού: {{ formatTitleCase(menuType.name) }}
                </template>

                <template #body>
                    Είστε σίγουροι ότι θέλετε να διαγράψετε το συγκεκριμένο μενού; Η διαγραφή θα γίνει μόνο στο μενού
                    και όχι στις συνδεδεμένες κατηγορίες & προϊόντα.
                </template>

                <template #actions>
                    <SecondaryButton @click="modalOpen=false">
                        Άκυρο
                    </SecondaryButton>

                    <DangerButton @click="destroy">
                        Διαγραφή
                    </DangerButton>
                </template>
            </PrimaryModal>
        </div>

        <CardContainer class="mb-4">
            {{ menuType.description }}
        </CardContainer>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 2xl:grid-cols-4 gap-2">
            <CategoryCard v-for="category in menuType.categories"
                          :key="category.id"
                          :category="category"/>
        </div>

    </AuthenticatedLayout>
</template>
