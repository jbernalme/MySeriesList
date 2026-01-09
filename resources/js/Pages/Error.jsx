// import nosignal from "../../../storage/app/public/img/nosignal.gif";
import GlitchText from "@/Components/GlitchText";
import TvFrame from "@/Components/TvFrame";
import { Head } from "@inertiajs/react";
import GuestLayout from "@/Layouts/GuestLayout";
import LinkCustom from "@/Components/LinkCustom";

const Error = ({ status }) => {
    const title = {
        503: "503: Servicio no disponible",
        500: "500: Error de servidor",
        404: "404: Página no encontrada",
        403: "403: Prohibido",
    }[status];

    const description = {
        503: "Lo siento, estamos realizando mantenimiento. Por favor, vuelva pronto.",
        500: "Ups, algo salió mal en nuestros servidores.",
        404: "Lo siento, no se pudo encontrar la página que está buscando.",
        403: "Lo siento, no tienes permiso para acceder a esta página.",
    }[status];

    return (
        <GuestLayout className="my-auto ">
            <Head>
                <title>Pagina de error</title>
                <meta
                    name="description"
                    content="Pagina con información sobre un error"
                />
            </Head>
            <div className="flex flex-col items-center justify-center gap-4 bg-primary">
                <div className="flex flex-col items-center text-light">
                    <TvFrame>
                        {/* <img
                            src={nosignal}
                            alt="Gif animado de television sin señal"
                        /> */}
                    </TvFrame>

                    <GlitchText className="text-7xl" text={` ${title}`} />
                    <GlitchText className="text-3xl " text={"Error page"} />
                    <p className="text-2xl ">{description}</p>
                </div>
                <LinkCustom
                    href="/"
                    styles={
                        " hover:bg-kiwi hover:text-secundary text-light px-6 py-2 mb-2 border border-kiwi rounded-none"
                    }
                >
                    Ir al inicio
                </LinkCustom>
            </div>
        </GuestLayout>
    );
};

export default Error;
