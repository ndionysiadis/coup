<script setup lang="ts">
import {Head} from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import HeadingLarge from "@/Components/Texts/HeadingLarge.vue";
import Breadcrumb from "@/Components/Pagination/Breadcrumb.vue";
import Breadcrumbs from "@/Components/Pagination/Breadcrumbs.vue";
import {formatTitleCase} from "@/Shared/globalFunctions";
import IconSecondaryButton from "@/Components/Buttons/IconSecondaryButton.vue";
import {PhArrowUUpLeft, PhFloppyDiskBack, PhPencilSimple} from "@phosphor-icons/vue";
import AppLink from "@/Components/Links/AppLink.vue";
import {useForm} from 'laravel-precognition-vue';
import FormInput from "@/Components/FormElements/FormInput.vue";
import CardContainer from "@/Components/Cards/CardContainer.vue";
import PrimaryButtonIcon from "@/Components/Buttons/PrimaryButtonIcon.vue";

const props = defineProps<{
    menuType: App.Data.MenuTypeData
}>()

const title = 'Επεξεργασία: ' + formatTitleCase(props.menuType.name)

const form = useForm<App.Data.MenuTypeData>(
    'put',
    route('menu.update', props.menuType),
    props.menuType
)
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
                    {{ formatTitleCase(menuType.name) }}
                </Breadcrumb>

                <Breadcrumb :href="route('menu.edit', menuType)">
                    Επεξεργασία
                </Breadcrumb>
            </Breadcrumbs>
        </template>

        <div class="flex items-center justify-between mb-4">
            <div class="flex flex-col">
                <HeadingLarge> {{ title }}</HeadingLarge>
            </div>

            <AppLink :href="route('menu.show', menuType)">
                <IconSecondaryButton title="Επιστροφή">
                    <PhArrowUUpLeft weight="bold"/>
                </IconSecondaryButton>
            </AppLink>
        </div>

        <form @submit.prevent="form.submit()">
            <CardContainer class="flex flex-col gap-4">
                <FormInput
                    id="text"
                    type="text"
                    label="Όνομα"
                    :required="true"
                    :autofocus="false"
                    :error="form.errors.name"
                    v-model="form.name"/>

                <FormInput
                    id="description"
                    type="text"
                    label="Περιγραφή"
                    :required="false"
                    :autofocus="false"
                    :error="form.errors.description"
                    v-model="form.description"/>

                <div>
                    <PrimaryButtonIcon type="submit">
                        <template #icon>
                            <PhFloppyDiskBack weight="fill"/>
                        </template>
                        Αποθήκευση
                    </PrimaryButtonIcon>
                </div>
            </CardContainer>
        </form>
    </AuthenticatedLayout>
</template>
