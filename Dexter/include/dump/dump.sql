--
-- PostgreSQL database dump
--

SET statement_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

--
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: clientes; Type: TABLE; Schema: public; Owner: dexter; Tablespace: 
--

CREATE TABLE clientes (
    id integer NOT NULL,
    nome_razao character varying NOT NULL,
    cpf_cnpj character varying NOT NULL,
    email character varying NOT NULL,
    telefone character varying NOT NULL,
    celular character varying,
    cep character varying(8) NOT NULL,
    endereco character varying NOT NULL,
    bairro character varying NOT NULL,
    cidade character varying NOT NULL,
    estado character varying NOT NULL,
    ip character varying(30)
);


ALTER TABLE public.clientes OWNER TO dexter;

--
-- Name: clientes_id_seq; Type: SEQUENCE; Schema: public; Owner: dexter
--

CREATE SEQUENCE clientes_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.clientes_id_seq OWNER TO dexter;

--
-- Name: clientes_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: dexter
--

ALTER SEQUENCE clientes_id_seq OWNED BY clientes.id;


--
-- Name: fale_conosco; Type: TABLE; Schema: public; Owner: dexter; Tablespace: 
--

CREATE TABLE fale_conosco (
    id integer NOT NULL,
    nome character varying NOT NULL,
    assunto character varying NOT NULL,
    mensagem text NOT NULL,
    email character varying(60) NOT NULL,
    ip character varying(30)
);


ALTER TABLE public.fale_conosco OWNER TO dexter;

--
-- Name: fale_conosco_id_seq; Type: SEQUENCE; Schema: public; Owner: dexter
--

CREATE SEQUENCE fale_conosco_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.fale_conosco_id_seq OWNER TO dexter;

--
-- Name: fale_conosco_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: dexter
--

ALTER SEQUENCE fale_conosco_id_seq OWNED BY fale_conosco.id;


--
-- Name: funcionalidades; Type: TABLE; Schema: public; Owner: dexter; Tablespace: 
--

CREATE TABLE funcionalidades (
    id integer NOT NULL,
    nome character varying(200),
    descricao character varying(350),
    url_icone character varying(300),
    ip character varying(30)
);


ALTER TABLE public.funcionalidades OWNER TO dexter;

--
-- Name: funcionalidades_id_seq; Type: SEQUENCE; Schema: public; Owner: dexter
--

CREATE SEQUENCE funcionalidades_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.funcionalidades_id_seq OWNER TO dexter;

--
-- Name: funcionalidades_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: dexter
--

ALTER SEQUENCE funcionalidades_id_seq OWNED BY funcionalidades.id;


--
-- Name: funcionarios; Type: TABLE; Schema: public; Owner: dexter; Tablespace: 
--

CREATE TABLE funcionarios (
    id integer NOT NULL,
    prf_id integer NOT NULL,
    nome character varying NOT NULL,
    email character varying NOT NULL,
    senha character varying NOT NULL,
    ip character varying(30)
);


ALTER TABLE public.funcionarios OWNER TO dexter;

--
-- Name: funcionarios_id_seq; Type: SEQUENCE; Schema: public; Owner: dexter
--

CREATE SEQUENCE funcionarios_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.funcionarios_id_seq OWNER TO dexter;

--
-- Name: funcionarios_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: dexter
--

ALTER SEQUENCE funcionarios_id_seq OWNED BY funcionarios.id;


--
-- Name: paginas; Type: TABLE; Schema: public; Owner: dexter; Tablespace: 
--

CREATE TABLE paginas (
    id integer NOT NULL,
    url character varying(30) NOT NULL,
    label character varying(30) NOT NULL,
    ip character varying(30)
);


ALTER TABLE public.paginas OWNER TO dexter;

--
-- Name: paginas_id_seq; Type: SEQUENCE; Schema: public; Owner: dexter
--

CREATE SEQUENCE paginas_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.paginas_id_seq OWNER TO dexter;

--
-- Name: paginas_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: dexter
--

ALTER SEQUENCE paginas_id_seq OWNED BY paginas.id;


--
-- Name: perfis; Type: TABLE; Schema: public; Owner: dexter; Tablespace: 
--

CREATE TABLE perfis (
    id integer NOT NULL,
    nome character varying(255) NOT NULL,
    ip character varying(30)
);


ALTER TABLE public.perfis OWNER TO dexter;

--
-- Name: perfis_id_seq; Type: SEQUENCE; Schema: public; Owner: dexter
--

CREATE SEQUENCE perfis_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.perfis_id_seq OWNER TO dexter;

--
-- Name: perfis_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: dexter
--

ALTER SEQUENCE perfis_id_seq OWNED BY perfis.id;


--
-- Name: servicos; Type: TABLE; Schema: public; Owner: dexter; Tablespace: 
--

CREATE TABLE servicos (
    id integer NOT NULL,
    nome character varying(200),
    descricao character varying(350),
    url_icone character varying(300),
    home boolean DEFAULT false,
    ip character varying(30)
);


ALTER TABLE public.servicos OWNER TO dexter;

--
-- Name: servicos_id_seq; Type: SEQUENCE; Schema: public; Owner: dexter
--

CREATE SEQUENCE servicos_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.servicos_id_seq OWNER TO dexter;

--
-- Name: servicos_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: dexter
--

ALTER SEQUENCE servicos_id_seq OWNED BY servicos.id;


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: dexter
--

ALTER TABLE ONLY clientes ALTER COLUMN id SET DEFAULT nextval('clientes_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: dexter
--

ALTER TABLE ONLY fale_conosco ALTER COLUMN id SET DEFAULT nextval('fale_conosco_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: dexter
--

ALTER TABLE ONLY funcionalidades ALTER COLUMN id SET DEFAULT nextval('funcionalidades_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: dexter
--

ALTER TABLE ONLY funcionarios ALTER COLUMN id SET DEFAULT nextval('funcionarios_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: dexter
--

ALTER TABLE ONLY paginas ALTER COLUMN id SET DEFAULT nextval('paginas_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: dexter
--

ALTER TABLE ONLY perfis ALTER COLUMN id SET DEFAULT nextval('perfis_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: dexter
--

ALTER TABLE ONLY servicos ALTER COLUMN id SET DEFAULT nextval('servicos_id_seq'::regclass);


--
-- Data for Name: clientes; Type: TABLE DATA; Schema: public; Owner: dexter
--

COPY clientes (id, nome_razao, cpf_cnpj, email, telefone, celular, cep, endereco, bairro, cidade, estado, ip) FROM stdin;
21	Zpcom Informatica	13121132123132132	cotato@zpcominformatica.com.br	40437784	962039978	09921040	Rua Canada,148	Centro	Diadema	SP	localhost
1	DHL Logi­stica ltda	09830583205	contato@dhl.com	Rua dos Transportes, 99	94894859	89899998	Rua dos Transportes, 99	Jardim Caminhão	São Paulo	SP	localhost
22	4linux Free Software Fundation	11111111111111111	contato@4linux.com.br	Rua Vergueiro,3057	962039978	09921040	Rua Vergueiro,3057	Vl. Mariana	São Paulo	SP	localhost
\.


--
-- Name: clientes_id_seq; Type: SEQUENCE SET; Schema: public; Owner: dexter
--

SELECT pg_catalog.setval('clientes_id_seq', 25, true);


--
-- Data for Name: fale_conosco; Type: TABLE DATA; Schema: public; Owner: dexter
--

COPY fale_conosco (id, nome, assunto, mensagem, email, ip) FROM stdin;
73	Denis Perciliano Ribeiro	Dúvida	Olá gostaria de mais informações sobre os produtos da empresa.	dpr001@gmail.com	localhost
74	Michelle Santos Leal	Informações	Olá gostaria de mais informações sobre o serviço de encomenda expressa.	mick.leal@gmail.com	localhost
75	nkhkjh	kjhkjhk		hkjhk	\N
76	Denis Perciliano Ribeiro	teste	sdfsdfsd	dpr001@gmail.com	\N
\.


--
-- Name: fale_conosco_id_seq; Type: SEQUENCE SET; Schema: public; Owner: dexter
--

SELECT pg_catalog.setval('fale_conosco_id_seq', 76, true);


--
-- Data for Name: funcionalidades; Type: TABLE DATA; Schema: public; Owner: dexter
--

COPY funcionalidades (id, nome, descricao, url_icone, ip) FROM stdin;
3	SUPORTE FULL TIME	Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, a atque porro magnam facilis earum odit nisi dignissimos quas commodi!	img/icon-support.png	localhost
2	CLOUD DATABASE	Lorem ipsum dolor sit amet, consectetur adipisicing elit. Velit, fugit soluta aperiam corporis unde pariatur rerum officiis dignissimos blanditiis omnis.	img/icon-cloud.png	localhost
1	COLETA AGENDADA	Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad, ab odit officiis quam similique illum cum ex quae. Voluptates, magni.	img/icon-calendar.png	localhost
\.


--
-- Name: funcionalidades_id_seq; Type: SEQUENCE SET; Schema: public; Owner: dexter
--

SELECT pg_catalog.setval('funcionalidades_id_seq', 7, true);


--
-- Data for Name: funcionarios; Type: TABLE DATA; Schema: public; Owner: dexter
--

COPY funcionarios (id, prf_id, nome, email, senha, ip) FROM stdin;
3	2	João	joao@dexter.com	e10adc3949ba59abbe56e057f20f883e	localhost
4	1	Denis	dpr001@gmail.com	e10adc3949ba59abbe56e057f20f883e	localhost
1	1	Admin	admin@dexter.com	e10adc3949ba59abbe56e057f20f883e	localhost
2	1	Fulano	fulano@dexter.com	e10adc3949ba59abbe56e057f20f883e	localhost
\.


--
-- Name: funcionarios_id_seq; Type: SEQUENCE SET; Schema: public; Owner: dexter
--

SELECT pg_catalog.setval('funcionarios_id_seq', 8, true);


--
-- Data for Name: paginas; Type: TABLE DATA; Schema: public; Owner: dexter
--

COPY paginas (id, url, label, ip) FROM stdin;
1	index.php	Início	localhost
2	cadastro.php	Cadastre-se	localhost
3	faleconosco.php	Fale Conosco	localhost
4	sobre.php	Sobre	localhost
\.


--
-- Name: paginas_id_seq; Type: SEQUENCE SET; Schema: public; Owner: dexter
--

SELECT pg_catalog.setval('paginas_id_seq', 4, true);


--
-- Data for Name: perfis; Type: TABLE DATA; Schema: public; Owner: dexter
--

COPY perfis (id, nome, ip) FROM stdin;
1	administrador	localhost
2	motorista	localhost
\.


--
-- Name: perfis_id_seq; Type: SEQUENCE SET; Schema: public; Owner: dexter
--

SELECT pg_catalog.setval('perfis_id_seq', 2, true);


--
-- Data for Name: servicos; Type: TABLE DATA; Schema: public; Owner: dexter
--

COPY servicos (id, nome, descricao, url_icone, home, ip) FROM stdin;
2	Entregas Aéreas	Lorem ipsum dolor sit amet, consectetur adipisicing elit. Soluta, fuga?	img/service-aereo.png	f	localhost
3	Entregas de Containers	Lorem ipsum dolor sit amet, consectetur adipisicing elit. Soluta, fuga?	img/service-navio.png	f	localhost
4	Transporte Ferroviário	Lorem ipsum dolor sit amet, consectetur adipisicing elit. Soluta, fuga?	img/service-trem.png	f	localhost
5	Transporte Fast	Lorem ipsum dolor sit amet, consectetur adipisicing elit. Soluta, fuga?	img/service-fast.png	f	localhost
6	Transporte de Malote	Lorem ipsum dolor sit amet, consectetur adipisicing elit. Soluta, fuga?	img/service-money.png	f	localhost
7	Coleta Agendada	Lorem ipsum dolor sit amet, consectetur adipisicing elit. Soluta, fuga?	img/service-calendar.png	f	localhost
8	Suporte Full Time	Lorem ipsum dolor sit amet, consectetur adipisicing elit. Soluta, fuga?	img/service-support.png	f	localhost
1	Ecommerce Delivey	Lorem ipsum dolor sit amet, consectetur adipisicing elit. Soluta, fuga?	img/service-loja.png	f	localhost
10	PARA SUA LOJA	Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad cumque mollitia rerum!	img/icon-shop.png	t	localhost
11	QUALQUER DESTINO	Lorem ipsum dolor sit amet, consectetur adipisicing elit. Atque omnis provident totam?	img/icon-world.png	t	localhost
12	NA PALMA DA MÃO	Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facere mollitia esse delectus?	img/icon-mobile.png	t	localhost
9	RÁPIDO E SIMPLES	Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repudiandae a voluptatibus neque.	img/icon-flash.png	t	localhost
\.


--
-- Name: servicos_id_seq; Type: SEQUENCE SET; Schema: public; Owner: dexter
--

SELECT pg_catalog.setval('servicos_id_seq', 19, true);


--
-- Name: clientes_pkey; Type: CONSTRAINT; Schema: public; Owner: dexter; Tablespace: 
--

ALTER TABLE ONLY clientes
    ADD CONSTRAINT clientes_pkey PRIMARY KEY (id);


--
-- Name: fale_conosco_pkey; Type: CONSTRAINT; Schema: public; Owner: dexter; Tablespace: 
--

ALTER TABLE ONLY fale_conosco
    ADD CONSTRAINT fale_conosco_pkey PRIMARY KEY (id);


--
-- Name: funcionalidades_pkey; Type: CONSTRAINT; Schema: public; Owner: dexter; Tablespace: 
--

ALTER TABLE ONLY funcionalidades
    ADD CONSTRAINT funcionalidades_pkey PRIMARY KEY (id);


--
-- Name: funcionarios_pkey; Type: CONSTRAINT; Schema: public; Owner: dexter; Tablespace: 
--

ALTER TABLE ONLY funcionarios
    ADD CONSTRAINT funcionarios_pkey PRIMARY KEY (id);


--
-- Name: perfis_pkey; Type: CONSTRAINT; Schema: public; Owner: dexter; Tablespace: 
--

ALTER TABLE ONLY perfis
    ADD CONSTRAINT perfis_pkey PRIMARY KEY (id);


--
-- Name: servicos_pkey; Type: CONSTRAINT; Schema: public; Owner: dexter; Tablespace: 
--

ALTER TABLE ONLY servicos
    ADD CONSTRAINT servicos_pkey PRIMARY KEY (id);


--
-- Name: funcionarios_prf_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: dexter
--

ALTER TABLE ONLY funcionarios
    ADD CONSTRAINT funcionarios_prf_id_fkey FOREIGN KEY (prf_id) REFERENCES perfis(id) ON UPDATE CASCADE;


--
-- Name: public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- PostgreSQL database dump complete
--

