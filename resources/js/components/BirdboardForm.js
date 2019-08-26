class BirdboardForm {
    constructor(data) {
        this.originalData = JSON.parse(JSON.stringify(data))
        this.errors = {}
        this.submitted = false

        Object.assign(this, data)
    }

    data() {
        return Object.keys(this.originalData).reduce((data, attribute) => {
            data[attribute] = this[attribute]

            return data
        }, {})
    }

    post(endpoint) {
        return this.submit(endpoint)
    }

    patch(endpoint) {
        return this.submit(endpoint, "patch")
    }

    delete(endpoint) {
        return this.submit(endpoint, "delete")
    }

    submit(endpoint, requestType = "post") {
        return axios[requestType](endpoint, this.data())
            .then(this.onSuccess.bind(this))
            .catch(this.onFail.bind(this))
    }

    onSuccess(response) {
        this.errors = {}
        this.submitted = true

        return response
    }

    onFail(error) {
        this.errors = error.response.data.errors
        this.submitted = false

        throw error
    }

    reset() {
        Object.assign(this, this.originalData)
    }
}

export default BirdboardForm
