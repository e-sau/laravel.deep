<template>
    <a :class="['btn', this.isAdmin ? 'btn-outline-danger' : 'btn-outline-success', 'mr-1', 'toggleAdmin']"
       href="#" @click="toggleAdmin">
        {{ this.isAdmin ? 'Понизить в правах' : 'Сделать админом' }}
    </a>
</template>

<script>
    export default {
        name: 'ToggleAdminButtonComponent',
        props: {
            user: Object,
        },

        data() {
            return {
                isAdmin: false
            }
        },

        methods: {
            toggleAdmin() {
                this.removeAlert();

                axios.post('/profile/toggleAdmin/', {
                    body: this.user.id
                })
                .then(data => {
                        if (data.data.response === 'OK') {
                            document.querySelector('.container').insertAdjacentHTML("afterbegin", "<div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">\n" +
                                "                " + data.data.message + "\n" +
                                "                <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">\n" +
                                "                    <span aria-hidden=\"true\">&times;</span>\n" +
                                "                </button>\n" +
                                "            </div>");
                            this.isAdmin = !this.isAdmin;
                        }
                        if (data.data.response === 'ERROR') {
                            document.querySelector('.container').insertAdjacentHTML("afterbegin", "<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">\n" +
                                "                " + data.data.message + "\n" +
                                "                <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">\n" +
                                "                    <span aria-hidden=\"true\">&times;</span>\n" +
                                "                </button>\n" +
                                "            </div>");
                        }
                    });
            },

            removeAlert() {
                const alert = document.querySelector('.alert');
                if (alert) alert.remove();
            }
        },

        mounted() {
            this.isAdmin = this.user.is_admin;
        },
    }
</script>
