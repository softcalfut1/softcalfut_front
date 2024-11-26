<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#4CAF50">
    <script src="../src/js/taildwind-3.4.5.js"></script>
    <link href="../src/style/tailwind.min.css" rel="stylesheet">
    <link rel="manifest" href="../manifest.json">
    <title><?php echo htmlspecialchars($titleHead); ?></title>
    <style>
        /* Menú hamburguesa */
        @media (min-width: 768px) {
            #nav-menu-small {
                display: none;
            }
        }


        @media (max-width: 768px) {
            nav {
                span.title {
                    text-align: center;
                    margin-bottom: 1rem;
                    display: block;
                    width: 100%;
                }
                li {
                    padding-top: 0.5rem;
                    padding-bottom: 0.5rem;
                    text-align: center;
                    width: 100%;
                }
            }
            .nav-menu-small {
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                position: absolute;
                top: 4.5rem;
                left: 0;
                right: 0;
                background-color: #2d3748;
                border-radius: 0 0 0.375rem 0.375rem;
                z-index: 10;
                margin: 2rem;
                margin-bottom: 0.5rem;
                width: max-content;
            }
        }
    </style>
</head>