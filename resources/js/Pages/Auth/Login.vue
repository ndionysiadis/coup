<script setup lang="ts">
import GuestLayout from '@/Layouts/GuestLayout.vue';
import {Head, useForm} from '@inertiajs/vue3';
import FormInput from "@/Components/FormElements/FormInput.vue";
import {PhAt, PhPassword} from "@phosphor-icons/vue";
import FormCheckbox from "@/Components/FormElements/FormCheckbox.vue";
import Copyrights from "@/Components/Copyrights.vue";
import PrimaryButtonWide from "@/Components/Buttons/PrimaryButtonWide.vue";

defineProps<{
    canResetPassword?: boolean;
    status?: string;
}>();

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => {
            form.reset('password');
        },
    });
};

const title = 'Login'
</script>

<template>
    <GuestLayout>
        <Head :title="title"/>

        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>

        <form @submit.prevent="submit">
            <div class="flex flex-col gap-4">
                <FormInput
                    label="Email"
                    v-model="form.email"
                    id="email"
                    type="email"
                    :required="true"
                    :autofocus="true"
                    :error="form.errors.email">

                    <PhAt weight="bold"/>

                </FormInput>

                <FormInput
                    label="Κωδικός"
                    v-model="form.password"
                    id="password"
                    type="password"
                    :required="true"
                    :autofocus="true"
                    :error="form.errors.password">

                    <PhPassword weight="bold"/>

                </FormInput>
            </div>

            <div class="block mt-4">
                <FormCheckbox
                    v-model="form.remember"
                    name="remember"
                    label="Να με θυμάσαι"
                />
            </div>

            <div class="flex items-center justify-end mt-4">
<!--                <TextLink v-if="canResetPassword"-->
<!--                          :href="route('password.request')">-->
<!--                    Forgot your password?-->
<!--                </TextLink>-->

                <PrimaryButtonWide :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Σύνδεση
                </PrimaryButtonWide>

            </div>
        </form>

       <template #bottom>
           <Copyrights/>
       </template>
    </GuestLayout>
</template>
