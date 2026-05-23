
document
.getElementById('reportForm')
.addEventListener('submit', async function(e){

    e.preventDefault();

    const formData = new FormData(this);

    document.getElementById('result').innerHTML =
        "<div class='alert alert-info'>Generating report...</div>";

    try {

        const response = await fetch('api/generate-report.php', {
            method: 'POST',
            body: formData
        });

        const data = await response.json();

        if(data.success){

            document.getElementById('result').innerHTML = `
                <div class="card mt-4">
                    <div class="card-body">

                        <h4>Generated Report</h4>

                        <pre style="white-space: pre-wrap;">
${data.report}
                        </pre>

                    </div>
                </div>
            `;

        } else {

            document.getElementById('result').innerHTML =
                "<div class='alert alert-danger'>Error generating report</div>";
        }

    } catch(error){

        document.getElementById('result').innerHTML =
            "<div class='alert alert-danger'>Server Error</div>";

        console.log(error);
    }

});
