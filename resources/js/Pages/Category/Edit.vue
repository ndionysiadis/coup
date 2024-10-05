<script setup lang="ts">
import { Head, router } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import HeadingLarge from "@/Components/Texts/HeadingLarge.vue";
import Breadcrumb from "@/Components/Pagination/Breadcrumb.vue";
import Breadcrumbs from "@/Components/Pagination/Breadcrumbs.vue";
import IconSecondaryButton from "@/Components/Buttons/IconSecondaryButton.vue";
import {
    PhArrowUUpLeft,
    PhFloppyDiskBack,
    PhTrash,
    PhWarningCircle,
} from "@phosphor-icons/vue";
import AppLink from "@/Components/Links/AppLink.vue";
import { useForm } from "laravel-precognition-vue-inertia";
import FormInput from "@/Components/FormElements/FormInput.vue";
import CardContainer from "@/Components/Cards/CardContainer.vue";
import PrimaryButtonIcon from "@/Components/Buttons/PrimaryButtonIcon.vue";
import { ref } from "vue";
import SecondaryButton from "@/Components/Buttons/SecondaryButton.vue";
import DangerButton from "@/Components/DangerButton.vue";
import PrimaryModal from "@/Components/Modals/PrimaryModal.vue";
import ComboboxSelector from "@/Components/Selectors/ComboboxSelector.vue";

const props = defineProps<{
    category: App.Data.Category.CategoryData;
}>();

const title = "Επεξεργασία: " + props.category.name;

const modalOpen = ref<boolean>(false);

const form = useForm<App.Data.Category.CategoryData>(
    "put",
    route("category.update", props.category),
    props.category,
);

function destroy() {
    router.delete(route("category.destroy", props.category), {
        preserveState: true,
        preserveScroll: true,
        only: ["toast"],
    });
}
</script>

<template>
    <Head :title="title" />

    <AuthenticatedLayout>
        <template #breadcrumbs>
            <Breadcrumbs>
                <Breadcrumb first :href="route('category.index')">
                    Κατηγορίες
                </Breadcrumb>

                <Breadcrumb :href="route('category.show', category)">
                    {{ category.name }}
                </Breadcrumb>

                <Breadcrumb :href="route('category.edit', category)">
                    Επεξεργασία
                </Breadcrumb>
            </Breadcrumbs>
        </template>

        <div class="mb-4 flex items-center justify-between">
            <div class="flex flex-col">
                <HeadingLarge> {{ title }}</HeadingLarge>
            </div>

            <div class="flex items-center gap-2">
                <AppLink :href="route('category.show', category)">
                    <IconSecondaryButton title="Επιστροφή">
                        <PhArrowUUpLeft weight="bold" />
                    </IconSecondaryButton>
                </AppLink>

                <IconSecondaryButton
                    title="Διαγραφή"
                    @click="modalOpen = !modalOpen"
                >
                    <PhTrash weight="fill" />
                </IconSecondaryButton>
            </div>

            <PrimaryModal :open="modalOpen" @closeModal="modalOpen = false">
                <template #icon>
                    <PhWarningCircle weight="bold" size="24" />
                </template>

                <template #title>
                    Διαγραφή κατηγορίας: {{ category.name }}
                </template>

                <template #body>
                    Είστε σίγουροι ότι θέλετε να διαγράψετε τη συγκεκριμένη
                    κατηγορία; Η διαγραφή θα γίνει μόνο στη κατηγορία και όχι
                    στους συνδεδεμένους καταλόγους & προϊόντα.
                </template>

                <template #actions>
                    <SecondaryButton @click="modalOpen = false">
                        Άκυρο
                    </SecondaryButton>

                    <DangerButton @click="destroy"> Διαγραφή </DangerButton>
                </template>
            </PrimaryModal>
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
                    v-model="form.name"
                />

                <FormInput
                    id="description"
                    type="text"
                    label="Περιγραφή"
                    :required="false"
                    :autofocus="false"
                    :error="form.errors.description"
                    v-model="form.description"
                />

                <ComboboxSelector
                    api
                    id="products"
                    v-model="form.products"
                    multiple
                    zautofocus="false"
                    label="Προϊόντα"
                    :display-value-function="
                        (x: App.Data.Product.ProductData) => x?.name
                    "
                    :route="route('api.product.index')"
                    :error="form.errors.products"
                />

                <ComboboxSelector
                    api
                    id="menu"
                    v-model="form.menuType"
                    label="Κατάλογος"
                    :display-value-function="
                        (x: App.Data.Menu.MenuTypeData) => x?.name
                    "
                    :route="route('api.menu.index')"
                    :error="form.errors.menuType"
                />

                <div>
                    <PrimaryButtonIcon type="submit" title="Αποθήκευση">
                        <template #icon>
                            <PhFloppyDiskBack weight="fill" size="16" />
                        </template>
                        Αποθήκευση
                    </PrimaryButtonIcon>
                </div>
            </CardContainer>
        </form>
    </AuthenticatedLayout>
</template>
