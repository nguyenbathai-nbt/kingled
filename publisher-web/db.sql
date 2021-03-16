--
-- PostgreSQL database dump
--

-- Dumped from database version 10.16
-- Dumped by pg_dump version 10.16

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

--
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: bill; Type: TABLE; Schema: public; Owner: kingleduse
--

CREATE TABLE public.bill (
    id bigint NOT NULL,
    name character varying,
    code character varying,
    status_id bigint,
    priority bigint,
    created_time timestamp without time zone,
    modified_time timestamp without time zone
);


ALTER TABLE public.bill OWNER TO kingleduse;

--
-- Name: bill_detail; Type: TABLE; Schema: public; Owner: kingleduse
--

CREATE TABLE public.bill_detail (
    id bigint NOT NULL,
    bill_id bigint,
    product_id bigint,
    quantity bigint,
    description character varying,
    note character varying,
    time_in timestamp without time zone,
    time_out timestamp without time zone,
    created_time timestamp without time zone,
    modified_time timestamp without time zone,
    conveyor_id bigint
);


ALTER TABLE public.bill_detail OWNER TO kingleduse;

--
-- Name: bill_detail_id_seq; Type: SEQUENCE; Schema: public; Owner: kingleduse
--

CREATE SEQUENCE public.bill_detail_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.bill_detail_id_seq OWNER TO kingleduse;

--
-- Name: bill_detail_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: kingleduse
--

ALTER SEQUENCE public.bill_detail_id_seq OWNED BY public.bill_detail.id;


--
-- Name: bill_id_seq; Type: SEQUENCE; Schema: public; Owner: kingleduse
--

CREATE SEQUENCE public.bill_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.bill_id_seq OWNER TO kingleduse;

--
-- Name: bill_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: kingleduse
--

ALTER SEQUENCE public.bill_id_seq OWNED BY public.bill.id;


--
-- Name: conveyor; Type: TABLE; Schema: public; Owner: kingleduse
--

CREATE TABLE public.conveyor (
    id bigint NOT NULL,
    name character varying(100),
    code character varying(100),
    created_time timestamp without time zone,
    modified_time timestamp without time zone
);


ALTER TABLE public.conveyor OWNER TO kingleduse;

--
-- Name: conveyor_id_seq; Type: SEQUENCE; Schema: public; Owner: kingleduse
--

CREATE SEQUENCE public.conveyor_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.conveyor_id_seq OWNER TO kingleduse;

--
-- Name: conveyor_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: kingleduse
--

ALTER SEQUENCE public.conveyor_id_seq OWNED BY public.conveyor.id;


--
-- Name: major; Type: TABLE; Schema: public; Owner: kingleduse
--

CREATE TABLE public.major (
    id bigint NOT NULL,
    name character varying,
    code character varying,
    created_time timestamp without time zone,
    modified_time timestamp without time zone
);


ALTER TABLE public.major OWNER TO kingleduse;

--
-- Name: major_id_seq; Type: SEQUENCE; Schema: public; Owner: kingleduse
--

CREATE SEQUENCE public.major_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.major_id_seq OWNER TO kingleduse;

--
-- Name: major_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: kingleduse
--

ALTER SEQUENCE public.major_id_seq OWNED BY public.major.id;


--
-- Name: product; Type: TABLE; Schema: public; Owner: kingleduse
--

CREATE TABLE public.product (
    id bigint NOT NULL,
    name character varying,
    code character varying,
    description character varying,
    created_time timestamp without time zone,
    modified_time timestamp without time zone
);


ALTER TABLE public.product OWNER TO kingleduse;

--
-- Name: product_id_seq; Type: SEQUENCE; Schema: public; Owner: kingleduse
--

CREATE SEQUENCE public.product_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.product_id_seq OWNER TO kingleduse;

--
-- Name: product_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: kingleduse
--

ALTER SEQUENCE public.product_id_seq OWNED BY public.product.id;


--
-- Name: role; Type: TABLE; Schema: public; Owner: kingleduse
--

CREATE TABLE public.role (
    id bigint NOT NULL,
    name character varying,
    code character varying,
    created_time timestamp without time zone,
    modified_time timestamp without time zone,
    major_id bigint
);


ALTER TABLE public.role OWNER TO kingleduse;

--
-- Name: role_id_seq; Type: SEQUENCE; Schema: public; Owner: kingleduse
--

CREATE SEQUENCE public.role_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.role_id_seq OWNER TO kingleduse;

--
-- Name: role_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: kingleduse
--

ALTER SEQUENCE public.role_id_seq OWNED BY public.role.id;


--
-- Name: status; Type: TABLE; Schema: public; Owner: kingleduse
--

CREATE TABLE public.status (
    id bigint NOT NULL,
    name character varying,
    code character varying,
    created_time timestamp without time zone,
    modified_time timestamp without time zone
);


ALTER TABLE public.status OWNER TO kingleduse;

--
-- Name: status_id_seq; Type: SEQUENCE; Schema: public; Owner: kingleduse
--

CREATE SEQUENCE public.status_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.status_id_seq OWNER TO kingleduse;

--
-- Name: status_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: kingleduse
--

ALTER SEQUENCE public.status_id_seq OWNED BY public.status.id;


--
-- Name: timein_timeout; Type: TABLE; Schema: public; Owner: kingleduse
--

CREATE TABLE public.timein_timeout (
    id bigint NOT NULL,
    bill_id bigint,
    product_id bigint,
    quantity bigint,
    time_in timestamp without time zone,
    user_timein_id bigint,
    time_out timestamp without time zone,
    user_timeout_id bigint,
    major_id bigint,
    delay_status character varying,
    count_time bigint,
    parent_id bigint,
    description character varying,
    created_time timestamp without time zone,
    modified_time timestamp without time zone
);


ALTER TABLE public.timein_timeout OWNER TO kingleduse;

--
-- Name: timein_timeout_id_seq; Type: SEQUENCE; Schema: public; Owner: kingleduse
--

CREATE SEQUENCE public.timein_timeout_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.timein_timeout_id_seq OWNER TO kingleduse;

--
-- Name: timein_timeout_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: kingleduse
--

ALTER SEQUENCE public.timein_timeout_id_seq OWNED BY public.timein_timeout.id;


--
-- Name: user; Type: TABLE; Schema: public; Owner: kingleduse
--

CREATE TABLE public."user" (
    id bigint NOT NULL,
    username character varying,
    password character varying,
    role_id bigint,
    created_time timestamp without time zone,
    modified_time timestamp without time zone,
    status_id bigint
);


ALTER TABLE public."user" OWNER TO kingleduse;

--
-- Name: user_id_seq; Type: SEQUENCE; Schema: public; Owner: kingleduse
--

CREATE SEQUENCE public.user_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.user_id_seq OWNER TO kingleduse;

--
-- Name: user_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: kingleduse
--

ALTER SEQUENCE public.user_id_seq OWNED BY public."user".id;


--
-- Name: bill id; Type: DEFAULT; Schema: public; Owner: kingleduse
--

ALTER TABLE ONLY public.bill ALTER COLUMN id SET DEFAULT nextval('public.bill_id_seq'::regclass);


--
-- Name: bill_detail id; Type: DEFAULT; Schema: public; Owner: kingleduse
--

ALTER TABLE ONLY public.bill_detail ALTER COLUMN id SET DEFAULT nextval('public.bill_detail_id_seq'::regclass);


--
-- Name: conveyor id; Type: DEFAULT; Schema: public; Owner: kingleduse
--

ALTER TABLE ONLY public.conveyor ALTER COLUMN id SET DEFAULT nextval('public.conveyor_id_seq'::regclass);


--
-- Name: major id; Type: DEFAULT; Schema: public; Owner: kingleduse
--

ALTER TABLE ONLY public.major ALTER COLUMN id SET DEFAULT nextval('public.major_id_seq'::regclass);


--
-- Name: product id; Type: DEFAULT; Schema: public; Owner: kingleduse
--

ALTER TABLE ONLY public.product ALTER COLUMN id SET DEFAULT nextval('public.product_id_seq'::regclass);


--
-- Name: role id; Type: DEFAULT; Schema: public; Owner: kingleduse
--

ALTER TABLE ONLY public.role ALTER COLUMN id SET DEFAULT nextval('public.role_id_seq'::regclass);


--
-- Name: status id; Type: DEFAULT; Schema: public; Owner: kingleduse
--

ALTER TABLE ONLY public.status ALTER COLUMN id SET DEFAULT nextval('public.status_id_seq'::regclass);


--
-- Name: timein_timeout id; Type: DEFAULT; Schema: public; Owner: kingleduse
--

ALTER TABLE ONLY public.timein_timeout ALTER COLUMN id SET DEFAULT nextval('public.timein_timeout_id_seq'::regclass);


--
-- Name: user id; Type: DEFAULT; Schema: public; Owner: kingleduse
--

ALTER TABLE ONLY public."user" ALTER COLUMN id SET DEFAULT nextval('public.user_id_seq'::regclass);


--
-- Data for Name: bill; Type: TABLE DATA; Schema: public; Owner: kingleduse
--

COPY public.bill (id, name, code, status_id, priority, created_time, modified_time) FROM stdin;
5	20022021 - 002	20022021 - 002	1	1	2021-02-20 05:43:20	2021-02-20 05:43:20
4	20022021 - 001	20022021 - 001	3	1	2021-02-20 05:37:23	2021-02-20 16:33:39
3	19022021 - 001	19022021 - 001	3	1	2021-02-19 10:36:46	2021-02-20 15:34:28
2	18022021 - 001	18022021 - 001	3	3	2021-02-18 15:10:15	2021-02-22 16:40:44
7	022021 - 001	022021 - 001	1	1	2021-02-26 01:59:49	2021-02-26 01:59:49
8	022021 - 002	022021 - 002	1	1	2021-02-26 03:52:01	2021-02-26 03:52:01
\.


--
-- Data for Name: bill_detail; Type: TABLE DATA; Schema: public; Owner: kingleduse
--

COPY public.bill_detail (id, bill_id, product_id, quantity, description, note, time_in, time_out, created_time, modified_time, conveyor_id) FROM stdin;
3	3	2	102	Thang tao	Note	\N	\N	2021-02-19 10:36:47	2021-02-19 10:37:53	1
4	4	1	111	Tháng\n	Note	\N	\N	2021-02-20 05:37:24	2021-02-20 05:38:38	1
5	5	1	1000	Nguồn guan\n	Note	\N	\N	2021-02-20 05:43:20	2021-02-20 05:43:20	\N
2	2	103	111	Thang tao	Note	\N	\N	2021-02-18 15:10:15	2021-02-22 02:12:17	1
6	7	1	321	Thang \n	Note	\N	\N	2021-02-26 01:59:50	2021-02-26 02:11:10	3
7	8	3	1990	Hh	Note	\N	\N	2021-02-26 03:52:02	2021-02-26 03:54:36	1
\.


--
-- Data for Name: conveyor; Type: TABLE DATA; Schema: public; Owner: kingleduse
--

COPY public.conveyor (id, name, code, created_time, modified_time) FROM stdin;
1	chuyen1	CHUYEN1	\N	\N
2	chuyen2	CHUYEN2	\N	\N
3	chuyen31	CHUYEN3	\N	2021-02-26 11:59:38
\.


--
-- Data for Name: major; Type: TABLE DATA; Schema: public; Owner: kingleduse
--

COPY public.major (id, name, code, created_time, modified_time) FROM stdin;
3	test	TEST	2021-02-18 14:36:53	2021-02-18 14:36:55
6	admin	ADMIN	2021-02-18 14:38:07	2021-02-18 14:38:09
1	khovt	KHOVT	2021-02-18 14:36:43	2021-02-18 14:36:45
2	sanxuat	SANXUAT	2021-02-18 14:36:49	2021-02-18 14:36:51
4	donggoi	DONGGOI	2021-02-18 14:36:57	2021-02-18 14:36:59
5	khotp	KHOTP	2021-02-18 14:37:01	2021-02-18 14:37:03
\.


--
-- Data for Name: product; Type: TABLE DATA; Schema: public; Owner: kingleduse
--

COPY public.product (id, name, code, description, created_time, modified_time) FROM stdin;
1	đèn	DEN		2021-02-18 07:26:26	2021-02-18 07:26:26
2	nguồn	NGUON		2021-02-18 08:47:25	2021-02-18 08:47:25
3	Bộ đèn led tube thủy tinh kèm máng, 28w, 120cm, ánh sáng trắng(25C/1T)	CB-T8-28-120-T-GL		2021-02-20 16:57:16	2021-02-20 16:57:16
4	Cụm đèn led downlight rọi 10w, AS trung tính, cob samsung	CUM D90-10SS-TT		2021-02-20 16:57:16	2021-02-20 16:57:16
5	Cụm đèn led downlight rọi 10w, AS vàng, cob samsung	CUM D90-10SS-V		2021-02-20 16:57:17	2021-02-20 16:57:17
6	Cụm đèn led downlight rọi 10w, AS trắng	CUM D90-10-T		2021-02-20 16:57:17	2021-02-20 16:57:17
7	Cụm đèn led downlight rọi 10w, AS vàng	CUM D90-10-V		2021-02-20 16:57:18	2021-02-20 16:57:18
8	Đèn led downlight 10w samsung led, kt120*35mm, a/s trung tính(50C/1T)	DDL-10SS-T120-TT		2021-02-20 16:57:18	2021-02-20 16:57:18
9	Đèn led downlight 10w samsung led, kt120*35mm, a/s trắng50C/1T)	DDL-10SS-T120-T		2021-02-20 16:57:19	2021-02-20 16:57:19
10	Đèn led downlight 10w samsung led, kt120*35mm, a/s vàng(50C/1T)	DDL-10SS-T120-V		2021-02-20 16:57:19	2021-02-20 16:57:19
11	Đèn led downlight 10w samsung led, kt120*35mm, a/s đỏi màu(50C/1T)	DDL-10SS-T120-DM		2021-02-20 16:57:20	2021-02-20 16:57:20
12	Đèn led downlight 15w samsung led, kt140*35mm, a/s trắng(50C/1T)	DDL-15SS-T140-T		2021-02-20 16:57:20	2021-02-20 16:57:20
13	Đèn led downlight 15w samsung led, kt140*35mm, a/s vàng(50C/1T)	DDL-15SS-T140-V		2021-02-20 16:57:21	2021-02-20 16:57:21
14	Đèn led downlight 15w samsung led, kt140*35mm, a/s trung tính(50C/1T)	DDL-15SS-T140-TT		2021-02-20 16:57:21	2021-02-20 16:57:21
15	Đèn led downlight 15w samsung led, kt140*35mm, a/s đổi màu(50C/1T)	DDL-15SS-T140-DM		2021-02-20 16:57:22	2021-02-20 16:57:22
16	Đèn led downlight 12w samsung led, kt140*30mm, a/s đổi màu(50C/1T)	DL-12SS-T140-DM		2021-02-20 16:57:22	2021-02-20 16:57:22
17	Đèn led downlight 12w samsung led, kt140*30mm, a/s trắng(50C/1T)	DL-12SS-T140-T		2021-02-20 16:57:23	2021-02-20 16:57:23
18	Đèn led downlight 12w samsung led, kt140*30mm, a/s trung tính(50C/1T)	DL-12SS-T140-TT		2021-02-20 16:57:23	2021-02-20 16:57:23
19	Đèn led downlight 12w samsung led, kt140*30mm, a/s vàng(50C/1T)	DL-12SS-T140-V		2021-02-20 16:57:24	2021-02-20 16:57:24
20	Đèn led downlight 12w, tròn 140mm,a/s  vàng(50C/1T)	DL-12-T140-V		2021-02-20 16:57:24	2021-02-20 16:57:24
21	Đèn led downlight 6w samsung led, kt100*30mm, a/s trắng (50C/1T)	DL-6SS-T100-T		2021-02-20 16:57:25	2021-02-20 16:57:25
22	Đèn led downlight 6w, tròn 100mm, AS đổi màu	DL-6-T100-DM		2021-02-20 16:57:25	2021-02-20 16:57:25
23	Đèn led downlight 6w, tròn 100mm, AS trắng	DL-6-T100-T		2021-02-20 16:57:26	2021-02-20 16:57:26
24	Đèn led downlight 6w, tròn 100mm, AS trung tính	DL-6-T100-TT		2021-02-20 16:57:27	2021-02-20 16:57:27
25	Đèn led downlight 8w samsung led, kt120*30mm, a/s đổi màu(50C/1T)	DL-8SS-T120-DM		2021-02-20 16:57:27	2021-02-20 16:57:27
26	Đèn led downlight 8w samsung led, kt120*30mm, a/s trắng(50C/1T)	DL-8SS-T120-T		2021-02-20 16:57:27	2021-02-20 16:57:27
27	Đèn led downlight 8w samsung led, kt120*30mm, a/s trung tính(50C/1T)	DL-8SS-T120-TT		2021-02-20 16:57:28	2021-02-20 16:57:28
28	Đèn led downlight 8w samsung led, kt 120*30mm, a/s vàng(50C/1T)	DL-8SS-T120-V		2021-02-20 16:57:28	2021-02-20 16:57:28
29	Đèn led downlight 8w, tròn 120mm, a/s vàng(50C/1T)	DL-8-T120-V		2021-02-20 16:57:29	2021-02-20 16:57:29
30	Đèn led downlight rọi 10w,kt 110*65mm,khoét 90-100mm, AS trắng, GX+ SS (30C/1T)	DLR-10SS-T110-T		2021-02-20 16:57:29	2021-02-20 16:57:29
31	Đèn led downlight rọi 10w,kt 110*65mm,khoét 90-100mm, AS trung tính, GX+ SS (30C/1T)	DLR-10SS-T110-TT		2021-02-20 16:57:30	2021-02-20 16:57:30
32	Đèn led downlight rọi 10w,kt 110*65mm,khoét 90-100mm, AS vàng, GX+ SS (30C/1T)	DLR-10SS-T110-V		2021-02-20 16:57:30	2021-02-20 16:57:30
33	Đèn led downlight rọi 10w, kt 110*65mm,khoét 90-100mm, AS trung tính Done+ Bridgelux (30C/T)	DLR-10-T110-TT		2021-02-20 16:57:31	2021-02-20 16:57:31
34	Đèn led downlight rọi 10w,kt 110*65mm,khoét 90-100mm, AS vàng, Done+ Bridgelux (30C/1T)	DLR-10-T110-V		2021-02-20 16:57:32	2021-02-20 16:57:32
35	Đèn led downlight rọi OPAL 16w, tròn 130mm, AS trắng	DLR-16SS-T130-T		2021-02-20 16:57:32	2021-02-20 16:57:32
36	Đèn led downlight rọi OPAL 16w, tròn 130mm, AS trung tính	DLR-16SS-T130-TT		2021-02-20 16:57:33	2021-02-20 16:57:33
37	Đèn led downlight rọi OPAL 16w, tròn 130mm, AS vàng	DLR-16SS-T130-V		2021-02-20 16:57:33	2021-02-20 16:57:33
38	Đèn led downlight rọi 16w, tròn 130mm, AS trắng	DLR-16-T130-T		2021-02-20 16:57:34	2021-02-20 16:57:34
39	Đèn led downlight rọi 16w, tròn 130mm, AS vàng	DLR-16-T130-V		2021-02-20 16:57:34	2021-02-20 16:57:34
40	Đèn led downlight rọi OPAL 20w,kt 150*70mm,khoét 130mm, AS trắng (30C/1T)	DLR-20SS-T150-T		2021-02-20 16:57:35	2021-02-20 16:57:35
41	Đèn led downlight rọi OPAL 20w,kt 150*70mm,khoét 130mm, AS trung tính (30C/1T)	DLR-20SS-T150-TT		2021-02-20 16:57:35	2021-02-20 16:57:35
42	Đèn led downlight rọi OPAL 20w,kt 150*70mm,khoét 130mm, AS vàng (30C/1T)	DLR-20SS-T150-V		2021-02-20 16:57:36	2021-02-20 16:57:36
43	Đèn led downlight rọi 20w,kt 150*70mm,khoét 130mm, AS trắng, Done+Bridgelux (30C/1T)	DLR-20-T150-T		2021-02-20 16:57:36	2021-02-20 16:57:36
44	Đèn led downlight rọi 20w,kt 150*70mm,khoét 130mm, AS trung tính, Done+Bridgelux (30C/1T)	DLR-20-T150-TT		2021-02-20 16:57:37	2021-02-20 16:57:37
45	Đèn led downlight rọi 20w,kt 150*70mm,khoét 130mm, AS vàng, Done+Bridgelux (30C/1T)	DLR-20-T150-V		2021-02-20 16:57:37	2021-02-20 16:57:37
46	Đèn led downlight rọi OPAL 30w,kt 150*70mm,khoét 130mm, AS trắng (30C/1T)	DLR-30SS-T150-T		2021-02-20 16:57:37	2021-02-20 16:57:37
47	Đèn led downlight rọi OPAL 30w,kt 150*70mm,khoét 130mm, AS trung tính (30C/1T)	DLR-30SS-T150-TT		2021-02-20 16:57:38	2021-02-20 16:57:38
48	Đèn led downlight rọi OPAL 30w,kt 150*70mm,khoét 130mm, AS vàng (30C/1T)	DLR-30SS-T150-V		2021-02-20 16:57:38	2021-02-20 16:57:38
49	Đèn led downlight rọi 30w,kt 150*70mm,khoét 130mm, AS trắng, Done+Bridgelux (30C/1T)	DLR-30-T150-T		2021-02-20 16:57:39	2021-02-20 16:57:39
50	Đèn led downlight rọi 30w,kt 150*70mm,khoét 130mm, AS vàng, Done+Bridgelux (30C/1T)	DLR-30-T150-V		2021-02-20 16:57:39	2021-02-20 16:57:39
51	Đèn led downlight rọi OPAL 7w, tròn 90mm, AS trắng	DLR-7SS-T90-T		2021-02-20 16:57:40	2021-02-20 16:57:40
52	Đèn led downlight rọi OPAL 7w, tròn 90mm, AS vàng	DLR-7SS-T90-V		2021-02-20 16:57:40	2021-02-20 16:57:40
53	Đèn led downlight rọi 7w, tròn 90mm, AS trắng	DLR-7-T90-T		2021-02-20 16:57:41	2021-02-20 16:57:41
54	Đèn led downlight rọi 7w, tròn 90mm, AS vàng	DLR-7-T90-V		2021-02-20 16:57:41	2021-02-20 16:57:41
55	Đèn rọi ray 12w Beryl,cob sam sung, ánh sáng trắng, vỏ trắng (30C/T)	DTL-12SS-T-T		2021-02-20 16:57:42	2021-02-20 16:57:42
56	Đèn rọi ray 12w Beryl,cob sam sung, ánh sáng trung tính, vỏ đen (30C/T)	DTL-12SS-TT-D		2021-02-20 16:57:42	2021-02-20 16:57:42
57	Đèn rọi ray 12w Beryl,cob sam sung, ánh sáng vàng, vỏ trắng (30C/T)	DTL-12SS-V-T		2021-02-20 16:57:43	2021-02-20 16:57:43
58	Đèn led rọi ray 12w, vỏ trắng AS vàng(30C/1T)	DTL-12-V-T		2021-02-20 16:57:43	2021-02-20 16:57:43
59	Đèn rọi ray 20w Beryl,cob sam sung, ánh sáng trắng, vỏ đen (30C/T)	DTL-20SS-T-D		2021-02-20 16:57:44	2021-02-20 16:57:44
60	Đèn rọi ray 20w Beryl,cob sam sung, ánh sáng trắng, vỏ trắng (30C/T)	DTL-20SS-T-T		2021-02-20 16:57:44	2021-02-20 16:57:44
61	Đèn rọi ray 20w Beryl,cob sam sung, ánh sáng trung tính, vỏ đen (30C/T)	DTL-20SS-TT-D		2021-02-20 16:57:45	2021-02-20 16:57:45
62	Đèn rọi ray 20w Beryl,cob sam sung, ánh sáng trung tính, vỏ trắng (30C/T)	DTL-20SS-TT-T		2021-02-20 16:57:46	2021-02-20 16:57:46
63	Đèn rọi ray 20w Beryl,cob sam sung, ánh sáng vàng, vỏ đen (30C/T)	DTL-20SS-V-D		2021-02-20 16:57:46	2021-02-20 16:57:46
64	Đèn rọi ray 20w Beryl,cob sam sung, ánh sáng vàng, vỏ trắng (30C/T)	DTL-20SS-V-T		2021-02-20 16:57:47	2021-02-20 16:57:47
65	Đèn led downlight KINGECO 7w, kt120*30mm,khoét 90-110mm,a/s đổi màu(50C/1T)	EC-DL-7-T120-DM		2021-02-20 16:57:47	2021-02-20 16:57:47
66	Đèn led downlight KINGECO 7w, kt120*30mm, khoét 90-110mm,a/s trắng(50C/1T)	EC-DL-7-T120-T		2021-02-20 16:57:48	2021-02-20 16:57:48
67	Đèn led downlight KINGECO 7w, kt120*30mm, khoét 90-110mm,a/s trung tính(50C/1T)	EC-DL-7-T120-TT		2021-02-20 16:57:48	2021-02-20 16:57:48
68	Đèn led downlight KINGECO 7w, kt120*30mm, khoét 90-110mm,a/s vàng(50C/1T)	EC-DL-7-T120-V		2021-02-20 16:57:49	2021-02-20 16:57:49
69	Đèn led downlight KINGECO 9w, kt 140*30mm,khoét 110-130mm,a/s đổi màu (50C/T)	EC-DL-9-T140-DM		2021-02-20 16:57:49	2021-02-20 16:57:49
70	Đèn led downlight KINGECO 9w, kt 140*30mm,khoét 110-130mm,a/s vàng (50C/T)	EC-DL-9-T140-V		2021-02-20 16:57:50	2021-02-20 16:57:50
71	Đèn led downlight KINGECO 7w, kt120*30mm, khoét 90-110mm,a/s trắng, mặt cong viền bạc(50C/1T)	EC-DLC-7-T120-T-B		2021-02-20 16:57:50	2021-02-20 16:57:50
72	Đèn led downlight KINGECO 7w, kt120*30mm, khoét 90-110mm,a/s trung tính, mặt cong viền bạc(50C/1T)	EC-DLC-7-T120-TT-B		2021-02-20 16:57:51	2021-02-20 16:57:51
73	Đèn led downlight KINGECO 7w, kt120*30mm, khoét 90-110mm,a/s trung tính, mặt cong viền vàng(50C/1T)	EC-DLC-7-T120-TT-V		2021-02-20 16:57:51	2021-02-20 16:57:51
74	Đèn led downlight KINGECO 7w, kt120*30mm, khoét 90-110mm,a/s vàng, mặt cong viền bạc(50C/1T)	EC-DLC-7-T120-V-B		2021-02-20 16:57:52	2021-02-20 16:57:52
75	Đèn led downlight KINGECO nhôm nhựa 7w, kt120*36mm,khoét 90-110mm,a/s đổi màu(50C/1T)	EC-DLNN-7-T120-DM		2021-02-20 16:57:52	2021-02-20 16:57:52
76	Đèn led downlight KINGECO nhôm nhựa 7w, kt120*36mm, khoét 90-110mm,a/s vàng(50C/1T)	EC-DLNN-7-T120-V		2021-02-20 16:57:53	2021-02-20 16:57:53
77	Đèn led downlight KINGECO nhôm nhựa 9w, kt 140*36mm,khoét 110-130mm,a/s đổi màu (50C/T)	EC-DLNN-9-T140-DM		2021-02-20 16:57:54	2021-02-20 16:57:54
78	Đèn led downlight KINGECO nhôm nhựa 9w, kt 140*36mm,khoét 110-130mm,a/s trắng (50C/T)	EC-DLNN-9-T140-T		2021-02-20 16:57:54	2021-02-20 16:57:54
79	Đèn led downlight KINGECO nhôm nhựa 9w, kt 140*36mm,khoét 110-130mm,a/s trung tính (50C/T)	EC-DLNN-9-T140-TT		2021-02-20 16:57:55	2021-02-20 16:57:55
80	Đèn led downlight KINGECO nhôm nhựa 9w, kt 140*36mm,khoét 110-130mm,a/s vàng (50C/T)	EC-DLNN-9-T140-V		2021-02-20 16:57:55	2021-02-20 16:57:55
81	Đèn led downlight KINGECO 7w, kt120*30mm,khoét 90-110mm,a/s đổi màu, mặt phẳng viền bạc(50C/1T)	EC-DLP-7-T120-DM-B		2021-02-20 16:57:56	2021-02-20 16:57:56
82	Đèn led downlight KINGECO 7w, kt120*30mm, khoét 90-110mm,a/s trung tính, mặt phẳng viền bạc(50C/1T)	EC-DLP-7-T120-TT-B		2021-02-20 16:57:56	2021-02-20 16:57:56
83	Đèn led downlight KINGECO 7w, kt120*30mm, khoét 90-110mm,a/s trung tính, mặt phẳng viền vàng(50C/1T)	EC-DLP-7-T120-TT-V		2021-02-20 16:57:56	2021-02-20 16:57:56
84	Đèn LED tube bán nguyệt 12w, 30cm, ánh sáng trắng(20C/1T)	EC-TBN-12-30-T		2021-02-20 16:57:57	2021-02-20 16:57:57
85	Đèn LED tube bán nguyệt 18w, 60cm, ánh sáng trắng(20C/1T)	EC-TBN-18-60-T		2021-02-20 16:57:58	2021-02-20 16:57:58
86	Đèn LED tube bán nguyệt 27w, 90cm, ánh sáng trắng(20C/1T)	EC-TBN-27-90-T		2021-02-20 16:57:58	2021-02-20 16:57:58
87	Đèn LED tube bán nguyệt 36w, 120cm, ánh sáng trắng(20C/1T)	EC-TBN-36-120-T		2021-02-20 16:57:59	2021-02-20 16:57:59
88	Đèn LED tube bán nguyệt 54w, 120cm, ánh sáng trắng(20C/1T)	EC-TBN-54-120-T		2021-02-20 16:57:59	2021-02-20 16:57:59
89	Đèn grilllight hộp 1x10w, AS trung tính, kt 127*127*75mm, lỗ khoét 110*110mm, cob ss (20C/T)	GL 1*10SS-V120-TT		2021-02-20 16:57:59	2021-02-20 16:57:59
90	Đèn grilllight hộp 1x10w, AS trung tính, kt 127*127*75mm, lỗ khoét 110*110mm, Done+ Bridgelux	GL 1*10-V120-TT		2021-02-20 16:58:00	2021-02-20 16:58:00
91	Đèn grilllight hộp 2x10w, AS trắng, kt 227*227*75mm, lỗ khoét 210*110mm, cob ss(10C/1T)	GL 2*10SS-V227-T		2021-02-20 16:58:00	2021-02-20 16:58:00
92	Đèn grilllight hộp 2x10w, AS trung tính, kt 227*227*75mm, lỗ khoét 210*110mm, cob ss(10C/1T)	GL 2*10SS-V227-TT		2021-02-20 16:58:01	2021-02-20 16:58:01
93	Đèn grilllight hộp 2x10w, AS vàng, kt 227*227*75mm, lỗ khoét 210*110mm, cob ss(10C/1T)	GL 2*10SS-V227-V		2021-02-20 16:58:01	2021-02-20 16:58:01
94	Đèn grilllight hộp 2x10w, AS trắng, kt 227*227*75mm, lỗ khoét 210*110mm, Done+ Bridgelux(18C/1T)	GL 2*10-V227-T		2021-02-20 16:58:02	2021-02-20 16:58:02
95	Đèn grilllight hộp 2x10w, AS trung tính, kt 227*227*75mm, lỗ khoét 210*110mm, Done+ Bridgelux(18C/1T)	GL 2*10-V227-TT		2021-02-20 16:58:02	2021-02-20 16:58:02
96	Đèn led grill 3x10w, AS trung tính,cob ss  (10C/1T)	GL 3*10SS-V334-TT		2021-02-20 16:58:03	2021-02-20 16:58:03
97	Đèn led grill 3x10w, AS vàng,cob ss  (10C/1T)	GL 3*10SS-V334-V		2021-02-20 16:58:03	2021-02-20 16:58:03
98	Đèn led sân vườn 309 5x1w, AS vàng	GR309		2021-02-20 16:58:04	2021-02-20 16:58:04
99	Đèn led sân vườn 309S 5x1w, AS vàng	GR309S		2021-02-20 16:58:04	2021-02-20 16:58:04
100	Đèn led sân vườn 8w,samsung, kích thước 95*250, ánh sáng vàng	GR-8SS-D95-250-V		2021-02-20 16:58:05	2021-02-20 16:58:05
101	Đèn led sân vườn 8w,samsung, kích thước 95*500, ánh sáng vàng	GR-8SS-D95-500-V		2021-02-20 16:58:05	2021-02-20 16:58:05
102	Đèn led sân vườn 8w,samsung, kích thước 95*800, ánh sáng vàng	GR-8SS-D95-800-V		2021-02-20 16:58:06	2021-02-20 16:58:06
103	Đèn led OBK 12w, samsung led, AS đổi màu, vỏ đen,115*56mm (30C/1T)	OBK-12SS-D115-DM-D		2021-02-20 16:58:07	2021-02-20 16:58:07
104	Đèn led OBK 12w, samsung led, AS đổi màu, vỏ trắng,115*56mm (30C/1T)	OBK-12SS-D115-DM-T		2021-02-20 16:58:07	2021-02-20 16:58:07
105	Đèn led OBK 12w, samsung led, AS trắng, vỏ đen,115*56mm (30C/1T)	OBK-12SS-D115-T-D		2021-02-20 16:58:07	2021-02-20 16:58:07
106	Đèn led OBK 12w, samsung led, AS trắng, vỏ trắng,115*56mm (30C/1T)	OBK-12SS-D115-T-T		2021-02-20 16:58:08	2021-02-20 16:58:08
107	Đèn led OBK 12w, samsung led, AS trung tính, vỏ đen,115*56mm (30C/1T)	OBK-12SS-D115-TT-D		2021-02-20 16:58:09	2021-02-20 16:58:09
108	Đèn led OBK 12w, samsung led, AS trung tính, vỏ trắng,115*56mm (30C/1T)	OBK-12SS-D115-TT-T		2021-02-20 16:58:09	2021-02-20 16:58:09
109	Đèn led OBK 12w, samsung led, AS vàng, vỏ đen,115*56mm (30C/1T)	OBK-12SS-D115-V-D		2021-02-20 16:58:10	2021-02-20 16:58:10
110	Đèn led OBK 12w, samsung led, AS vàng, vỏ trắng,115*56mm (30C/1T)	OBK-12SS-D115-V-T		2021-02-20 16:58:10	2021-02-20 16:58:10
111	Đèn led OBK 12w, AS trắng, vỏ trắng(30C/1T)	OBK-12-T-T		2021-02-20 16:58:11	2021-02-20 16:58:11
112	Đèn led OBK 12w, AS vàng, vỏ đen(30C/1T)	OBK-12-V-D		2021-02-20 16:58:11	2021-02-20 16:58:11
113	Đèn led OBK 12w, AS vàng, vỏ trắng(30C/1T)	OBK-12-V-T		2021-02-20 16:58:12	2021-02-20 16:58:12
114	Đèn led OBK 7w, AS vàng, vỏ đen(30C/1T)	OBK-7-V-D		2021-02-20 16:58:12	2021-02-20 16:58:12
115	Đèn led OBK 8w, samsung led, AS đổi màu, vỏ trắng,95*56mm (30C/1T)	OBK-8SS-D95-DM-T		2021-02-20 16:58:13	2021-02-20 16:58:13
116	Đèn led OBK 8w, samsung led, AS trắng, vỏ đen,95*56mm (30C/1T)	OBK-8SS-D95-T-D		2021-02-20 16:58:13	2021-02-20 16:58:13
117	Đèn led OBK 8w, samsung led, AS trắng, vỏ trắng,95*56mm (30C/1T)	OBK-8SS-D95-T-T		2021-02-20 16:58:14	2021-02-20 16:58:14
118	Đèn led OBK 8w, samsung led, AS trung tính, vỏ đen,95*56mm (30C/1T)	OBK-8SS-D95-TT-D		2021-02-20 16:58:14	2021-02-20 16:58:14
119	Đèn led OBK 8w, samsung led, AS trung tính, vỏ trắng,95*56mm (30C/1T)	OBK-8SS-D95-TT-T		2021-02-20 16:58:15	2021-02-20 16:58:15
120	Đèn led OBK 8w, samsung led, AS vàng, vỏ trắng,95*56mm (30C/1T)	OBK-8SS-D95-V-T		2021-02-20 16:58:15	2021-02-20 16:58:15
121	Đèn ống bơ chiếu rọi 10w, AS trắng, vỏ đen, 95*120(30C/1T)	OBR-10-D95-T-D		2021-02-20 16:58:16	2021-02-20 16:58:16
122	Đèn ống bơ chiếu rọi 10w, AS trung tính, vỏ đen,95*120(30C/1T)	OBR-10-D95-TT-D		2021-02-20 16:58:16	2021-02-20 16:58:16
123	Đèn ống bơ chiếu rọi 10w, AS trung tính, vỏ đen,choá bạc, 95*120(30C/1T)	OBR-10-D95-TT-D-B		2021-02-20 16:58:17	2021-02-20 16:58:17
124	Đèn ống bơ chiếu rọi 10w, AS trung tính, vỏ trắng, choá  đồng, 95*120(30C/1T)	OBR-10-D95-TT-T-DO		2021-02-20 16:58:17	2021-02-20 16:58:17
125	Đèn ống bơ chiếu rọi 10w, AS trung tính, vỏ trắng, choá trắng,95*120(30C/1T)	OBR-10-D95-TT-T-T		2021-02-20 16:58:18	2021-02-20 16:58:18
126	Đèn ống bơ chiếu rọi 10w, AS vàng, vỏ đen,95*120(30C/1T)	OBR-10-D95-V-D		2021-02-20 16:58:18	2021-02-20 16:58:18
127	Đèn ống bơ chiếu rọi 10w, AS vàng, vỏ đen,choá màu vàng 95*120(30C/1T)	OBR-10-D95-V-D-V		2021-02-20 16:58:19	2021-02-20 16:58:19
128	Đèn ống bơ chiếu rọi 10w, AS vàng, vỏ trắng,choá màu trắng, 95*120(30C/1T)	OBR-10-D95-V-T-T		2021-02-20 16:58:19	2021-02-20 16:58:19
129	Đèn ống bơ chiếu rọi COB 12w, AS trắng, vỏ đen(30C/1T)	OBR-12-T-D (COB)		2021-02-20 16:58:20	2021-02-20 16:58:20
130	Đèn ống bơ chiếu rọi COB 12w, AS trắng, vỏ trắng(30C/1T)	OBR-12-T-T (COB)		2021-02-20 16:58:20	2021-02-20 16:58:20
131	Đèn ống bơ chiếu rọi COB 12w, AS trung tính, vỏ trắng(30C/1T)	OBR-12-TT-T (COB)		2021-02-20 16:58:21	2021-02-20 16:58:21
132	Đèn ống bơ chiếu rọi COB 12w, AS vàng, vỏ đen(30C/1T)	OBR-12-V-D (COB)		2021-02-20 16:58:21	2021-02-20 16:58:21
133	Đèn ống bơ chiếu rọi COB 12w, AS vàng, vỏ trắng(30C/1T)	OBR-12-V-T (COB)		2021-02-20 16:58:22	2021-02-20 16:58:22
134	Đèn ống bơ chiếu rọi 15w, AS trắng, vỏ đen, chip bridgelux,115*140(20C/1T)	OBR-15-D115-T-D		2021-02-20 16:58:22	2021-02-20 16:58:22
135	Đèn ống bơ chiếu rọi 15w, AS trắng, vỏ trắng, chip bridgelux,115*140(20C/1T)	OBR-15-D115-T-T		2021-02-20 16:58:23	2021-02-20 16:58:23
136	Đèn ống bơ chiếu rọi 15w, AS trung tính, vỏ đen, chip bridgelux,115*140(20C/1T)	OBR-15-D115-TT-D		2021-02-20 16:58:23	2021-02-20 16:58:23
137	Đèn ống bơ chiếu rọi 15w, AS trung tính, vỏ trắng, chip bridgelux,115*140(20C/1T)	OBR-15-D115-TT-T		2021-02-20 16:58:24	2021-02-20 16:58:24
138	Đèn ống bơ chiếu rọi 15w, AS vàng, vỏ trắng, chip bridgelux,115*140(20C/1T)	OBR-15-D115-V-T		2021-02-20 16:58:24	2021-02-20 16:58:24
139	Đèn ống bơ chiếu rọi 15w, AS vàng, vỏ trắng,choá trắng, chip bridgelux,115*140(20C/1T)	OBR-15-D115-V-T-T		2021-02-20 16:58:25	2021-02-20 16:58:25
140	Đèn ống bơ chiếu rọi COB 15w, AS vàng, vỏ trắng (30C/T)	OBR-15-V-T (COB)		2021-02-20 16:58:25	2021-02-20 16:58:25
141	Đèn ống bơ chiếu rọi COB 18w, AS trắng, vỏ đen(30C/1T)	OBR-18-T-D (COB)		2021-02-20 16:58:26	2021-02-20 16:58:26
142	Đèn ống bơ chiếu rọi COB 18w, AS trắng, vỏ trắng(30C/1T)	OBR-18-T-T (COB)		2021-02-20 16:58:26	2021-02-20 16:58:26
143	Đèn ống bơ chiếu rọi COB 18w, AS vàng, vỏ đen(30C/1T)	OBR-18-V-D (COB)		2021-02-20 16:58:27	2021-02-20 16:58:27
144	Đèn ống bơ chiếu rọi COB 18w, AS vàng, vỏ trắng(30C/1T)	OBR-18-V-T (COB)		2021-02-20 16:58:27	2021-02-20 16:58:27
145	Đèn ống bơ chiếu rọi 20w, AS trắng, vỏ đen, chip bridgelux,115*140(20C/1T)	OBR-20-D115-T-D		2021-02-20 16:58:28	2021-02-20 16:58:28
146	Đèn ống bơ chiếu rọi 20w, AS trắng, vỏ trắng, chip bridgelux,115*140(20C/1T)	OBR-20-D115-T-T		2021-02-20 16:58:28	2021-02-20 16:58:28
147	Đèn ống bơ chiếu rọi 20w, AS trung tính, vỏ đen, chip bridgelux,115*140(20C/1T)	OBR-20-D115-TT-D		2021-02-20 16:58:29	2021-02-20 16:58:29
148	Đèn ống bơ chiếu rọi 20w, AS trung tính, vỏ đen, chip bridgelux,115*140(20C/1T),choá vàng	OBR-20-D115-TT-D-V		2021-02-20 16:58:30	2021-02-20 16:58:30
149	Đèn ống bơ chiếu rọi 20w, AS vàng, vỏ đen, chip bridgelux,115*140(20C/1T)	OBR-20-D115-V-D		2021-02-20 16:58:30	2021-02-20 16:58:30
150	Đèn ống bơ chiếu rọi 20w, AS vàng, vỏ trắng, chip bridgelux,115*140(20C/1T)	OBR-20-D115-V-T		2021-02-20 16:58:31	2021-02-20 16:58:31
151	Đèn ống bơ chiếu rọi 7w, AS trắng, vỏ đen, 95*120(30C/1T)	OBR-7-D95-T-D		2021-02-20 16:58:31	2021-02-20 16:58:31
152	Đèn ống bơ chiếu rọi 7w, AS trắng, vỏ trắng, 95*120(30C/1T)	OBR-7-D95-T-T		2021-02-20 16:58:32	2021-02-20 16:58:32
153	Đèn ống bơ chiếu rọi 7w, AS trung tính, vỏ đen, 95*120(30C/1T)	OBR-7-D95-TT-D		2021-02-20 16:58:32	2021-02-20 16:58:32
154	Đèn ống bơ chiếu rọi 7w, AS trung tính, vỏ đen,95*120(30C/1T), choá đồng	OBR-7-D95-TT-D-DO		2021-02-20 16:58:33	2021-02-20 16:58:33
155	Đèn ống bơ chiếu rọi 7w, AS trung tính, vỏ trắng,95*120(30C/1T)	OBR-7-D95-TT-T		2021-02-20 16:58:33	2021-02-20 16:58:33
156	Đèn ống bơ chiếu rọi 7w, AS vàng, vỏ đen, 95*120(30C/1T)	OBR-7-D95-V-D		2021-02-20 16:58:34	2021-02-20 16:58:34
157	Đèn ống bơ chiếu rọi 7w, AS vàng, vỏ trắng, 95*120(30C/1T)	OBR-7-D95-V-T		2021-02-20 16:58:34	2021-02-20 16:58:34
158	Đèn ống bơ chiếu rọi 7w, AS vàng, vỏ trắng, 95*120(30C/1T), choá đồng	OBR-7-D95-V-T-DO		2021-02-20 16:58:35	2021-02-20 16:58:35
159	Đèn ống bơ chiếu rọi COB 7w, AS vàng, vỏ đen(30C/1T)	OBR-7-V-D (COB)		2021-02-20 16:58:35	2021-02-20 16:58:35
160	Đèn ống bơ chiếu rọi COB 7w, AS vàng, vỏ trắng(30C/1T)	OBR-7-V-T (COB)		2021-02-20 16:58:36	2021-02-20 16:58:36
161	Đèn ốp trần trần viền 16w, ánh sáng trắng	OTV-16-T220-T		2021-02-20 16:58:36	2021-02-20 16:58:36
162	Đèn ốp trần trần viền 16w, ánh sáng trung tính	OTV-16-T220-TT		2021-02-20 16:58:37	2021-02-20 16:58:37
163	Đèn ốp trần trần viền 16w, ánh sáng vàng	OTV-16-T220-V		2021-02-20 16:58:37	2021-02-20 16:58:37
164	Đèn led panel 45w, 300x1200mm, AS vàng	PL-45-30120-V		2021-02-20 16:58:38	2021-02-20 16:58:38
165	Đèn led panel 9w đế màu cam, tròn 150mm, AS trắng (50C/1T)	SPL-9-T150-T		2021-02-20 16:58:38	2021-02-20 16:58:38
166	Đèn led panel 9w đế màu cam, tròn 150mm, AS trung tính (50C/1T)	SPL-9-T150-TT		2021-02-20 16:58:39	2021-02-20 16:58:39
167	Đèn led tube T8-18w-120cm, AS trung tính(25C/1T)	T8-18-120-TT		2021-02-20 16:58:39	2021-02-20 16:58:39
168	Đèn led tube T8 18w, AS vàng(25C/1T)	T8-18-120-V		2021-02-20 16:58:40	2021-02-20 16:58:40
169	Đèn led tube T8-22w-120cm, AS trắng(25C/1T)	T8-22-120-T		2021-02-20 16:58:40	2021-02-20 16:58:40
170	Đèn led tube T8-22w-120cm, AS trung tính(25C/1T)	T8-22-120-TT		2021-02-20 16:58:41	2021-02-20 16:58:41
171	Đèn led tube T8-22w-120cm, AS vàng(25C/1T)	T8-22-120-V		2021-02-20 16:58:41	2021-02-20 16:58:41
172	Đèn led tube T8-9w-60cm, AS trắng(25C/1T)	T8-9-60-T		2021-02-20 16:58:42	2021-02-20 16:58:42
173	Đèn tuýp bán nguyệt 24w, 60cm, ánh sáng trắng(8C/1T)	TBN-24-60-T		2021-02-20 16:58:42	2021-02-20 16:58:42
174	Đèn tuýp bán nguyệt 24w, 60cm, ánh sáng trung tính(8C/1T)	TBN-24-60-TT		2021-02-20 16:58:43	2021-02-20 16:58:43
175	Đèn tuýp bán nguyệt 24w, 60cm, ánh sáng vàng(10C/1T)	TBN-24-60-V		2021-02-20 16:58:43	2021-02-20 16:58:43
176	Đèn LED tube bán nguyệt 27w,chipled samsung,60cm,CRI>90, ánh sáng trắng(20C/1T)	TBN-27SS-60-T		2021-02-20 16:58:44	2021-02-20 16:58:44
177	Đèn LED tube bán nguyệt 27w,chipled samsung,60cm,CRI>90, ánh sáng trung tính(20C/1T)	TBN-27SS-60-TT		2021-02-20 16:58:44	2021-02-20 16:58:44
178	Đèn LED tube bán nguyệt 27w,chipled samsung,60cm,CRI>90, ánh sáng vàng(20C/1T)	TBN-27SS-60-V		2021-02-20 16:58:45	2021-02-20 16:58:45
179	Đèn LED tube bán nguyệt 36w, 120cm, ánh sáng trắng(20C/1T)	TBN-36-120-T		2021-02-20 16:58:45	2021-02-20 16:58:45
180	Đèn LED tube bán nguyệt 36w, 120cm, ánh sáng vàng(20C/1T)	TBN-36-120-V		2021-02-20 16:58:46	2021-02-20 16:58:46
181	Đèn LED tube bán nguyệt 52w, 120cm, ánh sáng trung tính(10C/1T)	TBN-52-120-TT		2021-02-20 16:58:46	2021-02-20 16:58:46
182	Đèn LED tube bán nguyệt 52w, 120cm, ánh sáng vàng(10C/1T)	TBN-52-120-V		2021-02-20 16:58:47	2021-02-20 16:58:47
183	Đèn LED tube bán nguyệt 54w,chipled samsung,120cm,CRI>90, ánh sáng trắng(20C/1T)	TBN-54SS-120-T		2021-02-20 16:58:47	2021-02-20 16:58:47
184	Đèn LED tube bán nguyệt 54w,chipled samsung,120cm,CRI>90, ánh sáng trung tính(20C/1T)	TBN-54SS-120-TT		2021-02-20 16:58:48	2021-02-20 16:58:48
185	Đèn LED tube bán nguyệt 54w,chipled samsung,120cm,CRI>90, ánh sáng vàng(20C/1T)	TBN-54SS-120-V		2021-02-20 16:58:48	2021-02-20 16:58:48
186	Đèn led tube T5 đầu vuông 12w, AS trắng(25C/1T)	VT5-12-90-T		2021-02-20 16:58:49	2021-02-20 16:58:49
187	Đèn led tube T5 đầu vuông 12w, AS vàng(25C/1T)	VT5-12-90-V		2021-02-20 16:58:49	2021-02-20 16:58:49
188	Đèn led tube T5 đầu vuông12w, samsung AS trắng(25C/1T)	VT5-12SS-90-T		2021-02-20 16:58:50	2021-02-20 16:58:50
189	Đèn led tube T5 đầu vuông12w, chipled samsung AS trung tính(25C/1T)	VT5-12SS-90-TT		2021-02-20 16:58:50	2021-02-20 16:58:50
190	Đèn led tube T5 đầu vuông12w, samsung AS vàng(25C/1T)	VT5-12SS-90-V		2021-02-20 16:58:51	2021-02-20 16:58:51
191	Đèn led tube T5 đầu vuông16w, AS trung tính(25C/1T)	VT5-16-120-TT		2021-02-20 16:58:51	2021-02-20 16:58:51
192	Đèn led tube T5 đầu vuông16w, chipled samsung, AS trắng(25C/1T)	VT5-16SS-120-T		2021-02-20 16:58:52	2021-02-20 16:58:52
193	Đèn led tube T5 đầu vuông16w, chipled samsung, AS vàng(25C/1T)	VT5-16SS-120-V		2021-02-20 16:58:52	2021-02-20 16:58:52
194	Đèn led tube T5 đầu vuông 4w, AS trắng(25C/1T)	VT5-4-30-T		2021-02-20 16:58:53	2021-02-20 16:58:53
195	Đèn led tube T5 đầu vuông 4w, AS (25C/1T)	VT5-4-30-TT		2021-02-20 16:58:53	2021-02-20 16:58:53
196	Đèn led tube T5 đầu vuông 4w, AS vàng(25C/1T)	VT5-4-30-V		2021-02-20 16:58:54	2021-02-20 16:58:54
197	Đèn led tube T5 đầu vuông 8w, AS (25C/1T)	VT5-8-60-T		2021-02-20 16:58:54	2021-02-20 16:58:54
198	Đèn led tube T5 đầu vuông 8w, AS trung tính(25C/1T)	VT5-8-60-TT		2021-02-20 16:58:55	2021-02-20 16:58:55
199	Đèn led tube T5 đầu vuông 8w, AS vàng(25C/1T)	VT5-8-60-V		2021-02-20 16:58:55	2021-02-20 16:58:55
200	Đèn led tube T5 đầu vuông 8w, samsung,AS trắng (25C/1T)	VT5-8SS-60-T		2021-02-20 16:58:56	2021-02-20 16:58:56
201	Đèn led tube T5 đầu vuông 8w, samsung,AS trung tính (25C/1T)	VT5-8SS-60-TT		2021-02-20 16:58:56	2021-02-20 16:58:56
202	Đèn led tube T5 đầu vuông 8w, samsung,AS vàng (25C/1T)	VT5-8SS-60-V		2021-02-20 16:58:57	2021-02-20 16:58:57
\.


--
-- Data for Name: role; Type: TABLE DATA; Schema: public; Owner: kingleduse
--

COPY public.role (id, name, code, created_time, modified_time, major_id) FROM stdin;
2	kho	KHO	\N	\N	1
3	chuyen	CHUYEN	\N	\N	2
4	test	TEST	\N	\N	3
1	admin	ADMIN	\N	\N	6
5	donggoi	DONGGOI	\N	\N	4
6	khotp	KHOTP	\N	\N	5
\.


--
-- Data for Name: status; Type: TABLE DATA; Schema: public; Owner: kingleduse
--

COPY public.status (id, name, code, created_time, modified_time) FROM stdin;
1	mở	Open	\N	\N
2	Đang tiến hàng	DANG_TIEN_HANG	\N	\N
3	Đã xong	DA_XONG	\N	\N
\.


--
-- Data for Name: timein_timeout; Type: TABLE DATA; Schema: public; Owner: kingleduse
--

COPY public.timein_timeout (id, bill_id, product_id, quantity, time_in, user_timein_id, time_out, user_timeout_id, major_id, delay_status, count_time, parent_id, description, created_time, modified_time) FROM stdin;
32	8	3	1990	2021-02-26 03:56:07	5	2021-02-26 03:57:20	5	2	\N	73	31	\N	2021-02-26 03:52:03	2021-02-26 03:57:20
16	4	1	111	2021-02-20 05:38:40	4	2021-02-20 05:38:57	4	1	\N	17	\N	\N	2021-02-20 05:37:25	2021-02-20 05:38:57
17	4	1	111	2021-02-20 05:39:46	5	2021-02-20 05:39:56	5	2	\N	10	16	\N	2021-02-20 05:37:25	2021-02-20 05:39:56
21	5	1	0	\N	\N	\N	\N	1	\N	\N	\N	\N	2021-02-20 05:43:21	2021-02-20 05:43:21
22	5	1	0	\N	\N	\N	\N	2	\N	\N	21	\N	2021-02-20 05:43:21	2021-02-20 05:43:21
23	5	1	0	\N	\N	\N	\N	3	\N	\N	22	\N	2021-02-20 05:43:22	2021-02-20 05:43:22
24	5	1	0	\N	\N	\N	\N	4	\N	\N	23	\N	2021-02-20 05:43:22	2021-02-20 05:43:22
25	5	1	0	\N	\N	\N	\N	5	\N	\N	24	\N	2021-02-20 05:43:22	2021-02-20 05:43:22
28	7	1	321	2021-02-26 04:05:59	6	2021-02-26 04:06:09	6	3	\N	10	27	\N	2021-02-26 01:59:51	2021-02-26 04:06:09
18	4	1	111	2021-02-20 05:45:54	6	2021-02-20 05:46:03	6	3	\N	9	17	\N	2021-02-20 05:37:25	2021-02-20 05:46:03
19	4	1	111	2021-02-20 05:47:04	7	2021-02-20 05:47:14	7	4	\N	10	18	\N	2021-02-20 05:37:26	2021-02-20 05:47:14
33	8	3	1990	2021-02-26 06:52:16	6	2021-02-26 06:52:27	6	3	\N	11	32	\N	2021-02-26 03:52:03	2021-02-26 06:52:27
20	4	1	111	2021-02-20 05:48:06	8	2021-02-20 05:48:17	8	5	\N	11	19	\N	2021-02-20 05:37:26	2021-02-20 05:48:17
10	2	1	111	\N	\N	\N	\N	5	\N	\N	9	\N	2021-02-18 15:10:15	2021-02-18 15:42:40
6	2	1	111	2021-02-18 17:10:50	1	2021-02-18 17:09:23	1	1	\N	56	\N	\N	2021-02-18 15:10:15	2021-02-18 17:10:57
7	2	1	111	2021-02-18 16:13:42	5	2021-02-18 16:13:44	5	2	\N	2	6	\N	2021-02-18 15:10:15	2021-02-18 16:13:44
8	2	1	111	2021-02-19 10:10:18	6	2021-02-19 10:10:23	6	3	\N	5	7	\N	2021-02-18 15:10:15	2021-02-19 10:10:23
9	2	1	111	2021-02-19 10:14:39	7	2021-02-19 10:14:49	7	4	\N	10	8	\N	2021-02-18 15:10:15	2021-02-19 10:14:49
13	3	2	102	\N	\N	\N	\N	3	\N	\N	12	\N	2021-02-19 10:36:48	2021-02-19 10:37:51
14	3	2	102	\N	\N	\N	\N	4	\N	\N	13	\N	2021-02-19 10:36:49	2021-02-19 10:37:51
15	3	2	102	\N	\N	\N	\N	5	\N	\N	14	\N	2021-02-19 10:36:49	2021-02-19 10:37:51
29	7	1	321	\N	\N	\N	\N	4	\N	\N	28	\N	2021-02-26 01:59:52	2021-02-26 02:11:08
11	3	2	102	2021-02-19 10:37:54	4	2021-02-19 10:38:07	4	1	\N	13	\N	\N	2021-02-19 10:36:48	2021-02-19 10:38:07
30	7	1	321	\N	\N	\N	\N	5	\N	\N	29	\N	2021-02-26 01:59:52	2021-02-26 02:11:08
12	3	2	102	2021-02-20 03:38:51	5	2021-02-20 03:39:21	5	2	\N	30	11	\N	2021-02-19 10:36:48	2021-02-20 03:39:21
26	7	1	321	2021-02-26 02:11:11	4	2021-02-26 03:00:36	4	1	\N	2965	\N	\N	2021-02-26 01:59:51	2021-02-26 03:00:36
27	7	1	321	2021-02-26 02:29:38	5	2021-02-26 03:30:16	5	2	\N	3638	26	\N	2021-02-26 01:59:51	2021-02-26 03:30:16
34	8	3	1990	\N	\N	\N	\N	4	\N	\N	33	\N	2021-02-26 03:52:03	2021-02-26 03:54:33
35	8	3	1990	\N	\N	\N	\N	5	\N	\N	34	\N	2021-02-26 03:52:03	2021-02-26 03:54:33
31	8	3	1990	2021-02-26 03:54:38	4	2021-02-26 03:54:59	4	1	\N	21	\N	\N	2021-02-26 03:52:02	2021-02-26 03:54:59
\.


--
-- Data for Name: user; Type: TABLE DATA; Schema: public; Owner: kingleduse
--

COPY public."user" (id, username, password, role_id, created_time, modified_time, status_id) FROM stdin;
3	admin	$2y$12$cWlhUjZvZjMxWjZJclVGb.LsAzCqemj8skZSokErADVdB7a/QOgt.	1	2021-02-18 05:05:32	2021-02-18 05:05:32	1
6	test	$2y$12$cWlhUjZvZjMxWjZJclVGb.LsAzCqemj8skZSokErADVdB7a/QOgt.	4	\N	\N	1
4	khovt	$2y$12$cWlhUjZvZjMxWjZJclVGb.LsAzCqemj8skZSokErADVdB7a/QOgt.	2	\N	\N	1
5	sanxuat	$2y$12$cWlhUjZvZjMxWjZJclVGb.LsAzCqemj8skZSokErADVdB7a/QOgt.	3	\N	\N	1
7	donggoi	$2y$12$cWlhUjZvZjMxWjZJclVGb.LsAzCqemj8skZSokErADVdB7a/QOgt.	5	\N	\N	1
8	khotp	$2y$12$cWlhUjZvZjMxWjZJclVGb.LsAzCqemj8skZSokErADVdB7a/QOgt.	6	\N	\N	1
\.


--
-- Name: bill_detail_id_seq; Type: SEQUENCE SET; Schema: public; Owner: kingleduse
--

SELECT pg_catalog.setval('public.bill_detail_id_seq', 7, true);


--
-- Name: bill_id_seq; Type: SEQUENCE SET; Schema: public; Owner: kingleduse
--

SELECT pg_catalog.setval('public.bill_id_seq', 8, true);


--
-- Name: conveyor_id_seq; Type: SEQUENCE SET; Schema: public; Owner: kingleduse
--

SELECT pg_catalog.setval('public.conveyor_id_seq', 16, true);


--
-- Name: major_id_seq; Type: SEQUENCE SET; Schema: public; Owner: kingleduse
--

SELECT pg_catalog.setval('public.major_id_seq', 6, true);


--
-- Name: product_id_seq; Type: SEQUENCE SET; Schema: public; Owner: kingleduse
--

SELECT pg_catalog.setval('public.product_id_seq', 202, true);


--
-- Name: role_id_seq; Type: SEQUENCE SET; Schema: public; Owner: kingleduse
--

SELECT pg_catalog.setval('public.role_id_seq', 6, true);


--
-- Name: status_id_seq; Type: SEQUENCE SET; Schema: public; Owner: kingleduse
--

SELECT pg_catalog.setval('public.status_id_seq', 7, true);


--
-- Name: timein_timeout_id_seq; Type: SEQUENCE SET; Schema: public; Owner: kingleduse
--

SELECT pg_catalog.setval('public.timein_timeout_id_seq', 35, true);


--
-- Name: user_id_seq; Type: SEQUENCE SET; Schema: public; Owner: kingleduse
--

SELECT pg_catalog.setval('public.user_id_seq', 27, true);


--
-- Name: bill_detail bill_detail_pkey; Type: CONSTRAINT; Schema: public; Owner: kingleduse
--

ALTER TABLE ONLY public.bill_detail
    ADD CONSTRAINT bill_detail_pkey PRIMARY KEY (id);


--
-- Name: bill bill_pkey; Type: CONSTRAINT; Schema: public; Owner: kingleduse
--

ALTER TABLE ONLY public.bill
    ADD CONSTRAINT bill_pkey PRIMARY KEY (id);


--
-- Name: conveyor conveyor_pkey; Type: CONSTRAINT; Schema: public; Owner: kingleduse
--

ALTER TABLE ONLY public.conveyor
    ADD CONSTRAINT conveyor_pkey PRIMARY KEY (id);


--
-- Name: major major_pkey; Type: CONSTRAINT; Schema: public; Owner: kingleduse
--

ALTER TABLE ONLY public.major
    ADD CONSTRAINT major_pkey PRIMARY KEY (id);


--
-- Name: product product_pkey; Type: CONSTRAINT; Schema: public; Owner: kingleduse
--

ALTER TABLE ONLY public.product
    ADD CONSTRAINT product_pkey PRIMARY KEY (id);


--
-- Name: role role_pkey; Type: CONSTRAINT; Schema: public; Owner: kingleduse
--

ALTER TABLE ONLY public.role
    ADD CONSTRAINT role_pkey PRIMARY KEY (id);


--
-- Name: status status_pkey; Type: CONSTRAINT; Schema: public; Owner: kingleduse
--

ALTER TABLE ONLY public.status
    ADD CONSTRAINT status_pkey PRIMARY KEY (id);


--
-- Name: timein_timeout timein_timeout_pkey; Type: CONSTRAINT; Schema: public; Owner: kingleduse
--

ALTER TABLE ONLY public.timein_timeout
    ADD CONSTRAINT timein_timeout_pkey PRIMARY KEY (id);


--
-- Name: user user_pkey; Type: CONSTRAINT; Schema: public; Owner: kingleduse
--

ALTER TABLE ONLY public."user"
    ADD CONSTRAINT user_pkey PRIMARY KEY (id);


--
-- PostgreSQL database dump complete
--

