<script setup lang="ts">
import { Head, router } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import HeadingLarge from "@/Components/Texts/HeadingLarge.vue";
import Breadcrumb from "@/Components/Pagination/Breadcrumb.vue";
import Breadcrumbs from "@/Components/Pagination/Breadcrumbs.vue";
import IconSecondaryButton from "@/Components/Buttons/IconSecondaryButton.vue";
import {
    PhArrowUUpLeft,
    PhCurrencyEur,
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
import FormNumber from "@/Components/FormElements/FormNumber.vue";
import ComboboxSelector from "@/Components/Selectors/ComboboxSelector.vue";

const props = defineProps<{
    product: App.Data.ProductData;
}>();

const title = "Επεξεργασία: " + props.product.name;

const modalOpen = ref<boolean>(false);

const form = useForm<App.Data.ProductData>(
    "put",
    route("product.update", props.product),
    props.product,
);

function destroy() {
    router.delete(route("product.destroy", props.product), {
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
                <Breadcrumb first :href="route('product.index')">
                    Προϊόντα
                </Breadcrumb>

                <Breadcrumb :href="route('product.show', product)">
                    {{ product.name }}
                </Breadcrumb>

                <Breadcrumb :href="route('product.edit', product)">
                    Επεξεργασία
                </Breadcrumb>
            </Breadcrumbs>
        </template>

        <div class="mb-4 flex items-center justify-between">
            <div class="flex flex-col">
                <HeadingLarge> {{ title }}</HeadingLarge>
            </div>

            <div class="flex items-center gap-2">
                <AppLink :href="route('product.show', product)">
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
                    Διαγραφή προϊόντος: {{ props.product.name }}
                </template>

                <template #body>
                    Είστε σίγουροι ότι θέλετε να διαγράψετε το συγκεκριμένο
                    προϊόν; Η διαγραφή θα γίνει μόνο στο προϊόν και όχι στα
                    συνδεδεμένα μενού & κατηγορίες.
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

                <FormNumber
                    id="price"
                    step="0.1"
                    label="Τιμή"
                    :required="false"
                    :autofocus="false"
                    :error="form.errors.price"
                    v-model="form.price"
                >
                    <PhCurrencyEur weight="bold" />
                </FormNumber>

                <ComboboxSelector
                    api
                    v-model="form.category"
                    label="Κατηγορία"
                    :display-value-function="
                        (x: App.Data.CategoryData) => x?.name
                    "
                    :route="route('api.category.index')"
                    :error="form.errors.category"
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
