<div class="results">
    <table cell-spacing="0">
        <thead>
            <td class="code">Course code</td>
            <td class="title">Course title</td>
            <td class="credit">Credit</td>
            <td class="grade">Grade</td>
            <td class="point">Grade Point</td>
        </thead>
        <tbody>

            <?php
            for ($i = 0; $i < 6; $i++) { ?>
                <tr>
                    <td class="code">CS101</td>
                    <td class="title">Intro to Programming</td>
                    <td class="credit">3</td>
                    <td class="grade">A+</td>
                    <td class="point">4</td>
                </tr>
            <?php } ?>

            <tr class="footer">
                <td colspan="2">Status: promoted</td>
                <td>Total credits: 12</td>
                <td>SGPA: 4</td>
                <td>CGPA: 3.8</td>
            </tr>
        </tbody>
    </table>
</div>